<?php
class Sendmail {

  const SUBJECT = "お問い合わせ受付";
  const HEADER = "from: sample@example.com\nbcc: sample@example.com";

  private $data;
  private $message;
  private $to = "sample@example.com";
  private $count;

  private function get_data() {

    $date = date("Y/n/j H:i:s");
    $name = (isset($_GET["uName"]) && $_GET["uName"] != "") ? $_GET["uName"] : "---";
    $email = (isset($_GET["uEmail"]) && $_GET["uEmail"] != "") ? $_GET["uEmail"] : "---";
    $url = (isset($_GET["uUrl"]) && $_GET["uUrl"] != "") ? $_GET["uUrl"] : "---";
    $tel = (isset($_GET["uTel"]) && $_GET["uTel"] != "") ? $_GET["uTel"] : "---";
    $memo = (isset($_GET["uMemo"]) && $_GET["uMemo"] != "") ? $_GET["uMemo"] : "---";

    $this->write_file();
    $this->data = array($date, $name, $email, $url, $tel, $memo, $this->count);
    $this->to = $email;

  }

  private function create_message() {

    $this->message .= "\n"
      . $this->data[1] . " 様\n"
      . "\n"
      . "お問い合わせくださり誠にありがとうございます。\n"
      . "\n"
      . "下記の内容で受け付けいたしました。\n"
      . "\n"
      . "----- 【ご記入内容】 -----\n"
      . "受付番号: " . $this->data[6] . "\n"
      . "\n"
      . "名前: " . $this->data[1] . "\n"
      . "メールアドレス: " . $this->data[2] . "\n"
      . "URL: " . $this->data[3] . "\n"
      . "電話番号: " . $this->data[4] . "\n"
      . "お問い合わせ内容: " . $this->data[5] . "\n"
      . "\n";

  }

  private function write_file() {

    $this->count = file_get_contents("count.txt");
    $fp = fopen("count.txt", "w+");

    if ($fp) {
      fwrite($fp, $this->count + 1);
      fclose($fp);
    }

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
