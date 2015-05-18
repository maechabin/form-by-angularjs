<?php
class Sendmail {

  const TO = "sample@example.com";
  const SUBJECT = "お問い合わせ受付";
  const HEADER = "from: sample@example.com";

  private $data;
  private $message;

  private function get_data() {

    $date = date("Y/n/j H:i:s");
    $company = (isset($_POST["company"]) && $_POST["company"] != "") ? $_POST["company"] : "---";
    $person = (isset($_POST["person"]) && $_POST["person"] != "") ? $_POST["person"] : "---";
    $tel = (isset($_POST["tel"]) && $_POST["tel"] != "") ? $_POST["tel"] : "---";
    $email = (isset($_POST["email"]) && $_POST["email"] != "") ? $_POST["email"] : "---";
    $address = (isset($_POST["address"]) && $_POST["address"] != "") ? $_POST["address"] : "---";
    $inquiry = (isset($_POST["inquiry"]) && $_POST["inquiry"] != "") ? $_POST["inquiry"] : "---";

    $this->data = array($date, $company, $person, $tel, $email, $address, $inquiry);

  }

  private function create_message() {

    $this->message .= "\n"
      . $this->data[1] . " " .$this->data[2] . " 様\n"
      . "\n"
      . "お問い合わせくださり誠にありがとうございます。\n"
      . "\n"
      . "下記の内容で受け付けいたしました。\n"
      . "\n"
      . "----- 【ご記入内容】 -----\n"
      . "受付番号: " . "\n"
      . "\n"
      . "会社名: " . $this->data[1] . "\n"
      . "担当者名: " . $this->data[2] . "\n"
      . "電話番号: " . $this->data[3] . "\n"
      . "メールアドレス: " . $this->data[4] . "\n"
      . "住所: " . $this->data[5] . "\n"
      . "お問い合わせ内容: " . $this->data[6] . "\n"
      . "\n";
  }

  private function write_file() {

  }

  private function send_mail() {

    mb_language("japanese");
    mb_internal_encoding("utf-8");
    mb_send_mail(
      self::TO,
      self::SUBJECT,
      $this->message,
      self::HEADER
    );

  }

  public function init() {
    $this->get_data();
    $this->create_message();
    $this->send_mail();
    echo $this->message;
  }

}
