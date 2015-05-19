<?php
class Sendmail {

  const SUBJECT = "お問い合わせ受付";
  const HEADER = "from: sample@example.com bcc: sample@example.com";

  private $data;
  private $message;
  private $to = "sample@example.com";

  private function get_data() {

    $date = date("Y/n/j H:i:s");
    $company = (isset($_GET["company"]) && $_GET["company"] != "") ? $_GET["company"] : "---";
    $person = (isset($_GET["person"]) && $_GET["person"] != "") ? $_GET["person"] : "---";
    $tel = (isset($_GET["tel"]) && $_GET["tel"] != "") ? $_GET["tel"] : "---";
    $email = (isset($_GET["email"]) && $_GET["email"] != "") ? $_GET["email"] : "---";
    $address = (isset($_GET["address"]) && $_GET["address"] != "") ? $_GET["address"] : "---";
    $inquiry = (isset($_GET["inquiry"]) && $_GET["inquiry"] != "") ? $_GET["inquiry"] : "---";

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
      $this->to,
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
