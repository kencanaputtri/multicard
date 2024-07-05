//*******************************libraries********************************
//RFID-----------------------------
#include <SPI.h>
#include <MFRC522.h>

//NodeMCU--------------------------
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
//************************************************************************

#define SS_PIN  D2  //Pin D2
#define RST_PIN D1  //Pin D1
#define BUZZER  D4

MFRC522 mfrc522(SS_PIN, RST_PIN);   // Membuat instance MFRC522

// int buzzPin = D8;

//************************************************************************
/* Seting koneksi wifi dengan user dan password wifi yang ada. */
const char *ssid = "Puttri's phone";  
const char *password = "puja2205";

//************************************************************************
String URL = "http://192.168.190.227/multicardsystem/multicard/service/dataget.php";  // 
String getData, Link;
String OldCardID = "";
unsigned long previousMillis = 0;

//************************************************************************


void setup() {
  delay(1000);
  Serial.begin(115200);
  SPI.begin();          // Init SPI bus
  mfrc522.PCD_Init();   // Init MFRC522 card
  connectToWiFi();
  pinMode(BUZZER, OUTPUT);
}

//************************************************************************
void loop() {
  // Cek kondisi apakah terkoneksi ke wifi
  if(!WiFi.isConnected()){
    connectToWiFi();    // Konek ke wifi
  }

  //---------------------------------------------
  if (millis() - previousMillis >= 15000) {
    previousMillis = millis(); 
    OldCardID="";
  }
  //---------------------------------------------
  
  //Cek kartu RFID yang di scan
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return;       //got to start of loop if there is no card present
  }
  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    return;       //if read card serial(0) returns 1, the uid struct contians the ID of the read card.
  }
  String CardID ="";
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    CardID += mfrc522.uid.uidByte[i];
  }
  
  if( CardID == OldCardID ){
    return;
  }
  else{
    OldCardID = CardID;
  }
  
  SendCardID(CardID);
  delay(800);
  // Bunyikan buzzer
  tone(BUZZER, 1000); // Bunyikan buzzer dengan frekuensi 1000 Hz
  delay(500);           // Tunggu 500 milidetik
  noTone(BUZZER);     // Matikan buzzer
}

//************Kirim UID Kartu RFID ke website*************
void SendCardID( String uid ){
  Serial.println("Sending the Card ID");
  
  if(WiFi.isConnected()){
    HTTPClient http;                      // Deklarasi objek dari class HTTPClient
    WiFiClient client;
    // String Data GET
    getData = "?uidrfid=" + String(uid) + "&tempat=Perpustakaan";  // Menambahkan data String UID Kartu ke metode GET
    // String metode GET
    Link = URL + getData;
    http.begin(client, Link);             // Inisialisasi HTTP request. Spesifik content-type header
    int httpCode = http.GET();            // Kirim permintaan
    String payload = http.getString();    // Respon Get

    Serial.println(httpCode); 
    Serial.println("client"); 
    Serial.println(client);             
    Serial.println(uid);                 
    Serial.println(Link);
    // Serial.println(payload);              

    if (httpCode == 200) {
      if (payload.substring(0, 5) == "login") {
        String user_name = payload.substring(5);
        Serial.println(user_name);
      }else if (payload.substring(0, 6) == "logout") {
        String user_name = payload.substring(6);  
        Serial.println(user_name);    
      }if (payload == "succesful") {
        Serial.println("succesful");
      }else if (payload == "available") {
        Serial.println("available");
      }
      delay(100);
      http.end();   // Tutup Koneksi ke server
    }else{
      Serial.println("gagal simpan data");
    }
  }

}

//********************Konek ke WiFi******************
void connectToWiFi(){
    WiFi.mode(WIFI_OFF);              
    delay(1000);
    WiFi.mode(WIFI_STA);
    Serial.println("Connecting to ");
    Serial.println(ssid);
    WiFi.begin(ssid, password);
    
    while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.print(".");
    }
    Serial.println("");
    Serial.println("Connected");
  
    Serial.print("IP address: ");
    Serial.println(WiFi.localIP());  // IP address NodeMCU di jaringan WiFi
    
    delay(1000);
}
//====================================================