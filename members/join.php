<?php

session_start();

$s_id = isset($_SESSION["s_id"])? $_SESSION["s_id"]:"";
$s_name = isset($_SESSION["s_name"])? $_SESSION["s_name"]:"";
// echo "session ID : ".$s_id."/ name : ".$s_name;
?>

<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>회원가입</title>
    <style>
      body,
      input,
      select,
      option,
      button {
        font-size: 24px;
      }
      input[type="checkbox"] {
        width: 24px;
        height: 24px;
      }
      span {
        font-size: 14px;
        color: red;
      }
    </style>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../style/join.css" />
    <script type="text/javascript">
      function form_check() {
        var u_name = document.getElementById("u_name");
        var u_id = document.getElementById("u_id");
        var pwd = document.getElementById("pwd");
        var repwd = document.getElementById("repwd");
        var mobile = document.getElementById("mobile");

        if (u_name.value == "") {
          var err_txt = document.querySelector(".err_name");
          err_txt.innerHTML = "<em>이름을 입력하세요.</em>";
          u_name.focus();
          return false;
        }

        if (u_id.value == "") {
          var err_txt = document.querySelector(".err_uid");
          err_txt.innerHTML = "<em>아이디를 입력하세요.</em>";
          u_id.focus();
          return false;
        }
        var u_id_len = u_id.value.length;
        if (u_id_len < 4 || u_id_len > 12) {
          var err_txt = document.querySelector(".err_uid");
          err_txt.textContent = "아이디는 4~12글자만 입력할 수 있습니다.";
          u_id.focus();
          return false;
        }

        if (pwd.value == "") {
          var err_txt = document.querySelector(".err_pwd");
          err_txt.innerHTML = "<em>비밀번호를 입력하세요.</em>";
          pwd.focus();
          return false;
        }
        var pwd_len = pwd.value.length;
        if (pwd_len < 4 || pwd_len > 8) {
          var err_txt = document.querySelector(".err_pwd");
          err_txt.textContent = "비밀번호는 4~8글자만 입력할 수 있습니다.";
          pwd.focus();
          return false;
        }

        if (pwd.value != repwd.value) {
          var err_txt = document.querySelector(".err_pwd");
          err_txt.innerHTML = "<em>비밀번호를 확인해주세요.</em>";
          repwd.focus();
          return false;
        }
        if (mobile.value == "") {
          var err_txt = document.querySelector(".err_mobile");
          err_txt.innerHTML = "<em>전화번호를 입력하세요.</em>";
          mobile.focus();
          return false;
        }
        var reg_mobile = /^[0-9]{10,11}$/g;
        if (!reg_mobile.test(mobile.value)) {
          var err_txt = document.querySelector(".err_mobile");
          err_txt.textContent = "전화번호는 숫자만 입력할 수 있습니다.";
          mobile.focus();
          return false;
        }
        if (!agree.checked) {
          alert("약관 동의가 필요합니다.");
          agree.focus();
          return false;
        }
      }
      function change_email() {
        var email_dns = document.getElementById("email_dns");
        var email_sel = document.getElementById("email_sel");
        var idx = email_sel.options.selectedIndex;
        var sel_value = email_sel.options[idx].value;
        email_dns.value = sel_value;
      }
      function id_search() {
        window.open(
          "search_id.php",
          "",
          "width=600, height=250, left=0, top=0"
        );
      }
      function adress_search() {
        window.open(
          "search_adress.php",
          "",
          "width=600px, height=250px, left=0, top=0"
        );
      }
    </script>
  </head>
  <body>
    <header>
      <div class="header">
        <div class="logo">
          <h1 class="tasty">
            <a href="index.php" style="color: #38a69b; margin-bottom: 10px"
              >Tasty</a
            >
          </h1>
        </div>
        <div class="menu">
          <ul>
            <li class="login"><a href="../login/login.php">로그인</a></li>
              <li class="intro"><a href="../intro.php">소개</a></li>
            </p>
          </ul>
        </div>
      </div>
    </header>
    <form
      name="join_form"
      action="insert.php"
      method="get"
      onsubmit="return form_check()"
    >
      <fieldset>
        <legend>회원가입</legend>
        <p>
          <label for="u_name">이름</label>
          <input type="text" name="u_name" id="u_name" />
          <br />
          <span class="err_name"></span>
        </p>

        <p>
          <label for="u_id">아이디</label>
          <input type="text" name="u_id" id="u_id" placeholder="중복확인을 눌러주세요" readonly />
          <button type="button" onclick="id_search()">아이디 중복확인</button>
          <br />
          <span class="err_uid"></span>
        </p>

        <p>
          <label for="pwd">비밀번호</label>
          <!-- <input type="password" name="pwd" id="pwd"> -->
          <input type="password" name="pwd" id="pwd" />
          <br />
          <span class="err_pwd"></span>
        </p>

        <p>
          <label for="repwd">비밀번호 확인</label>
          <!-- <input type="password" name="repwd" id="repwd"> -->
          <input type="password" name="repwd" id="repwd" />
          <br />
          <span class="err_pwd"></span>
        </p>

        <p>
          <label for="mobile">전화번호</label>
          <input type="text" name="mobile" id="mobile" />
          <br />
          <span class="err_mobile">"-" 없이 숫자만 입력</span>
        </p>

        <p>
          <label for="email">이메일</label>
          <input type="text" name="email_id" id="email_id" /> @
          <input type="text" name="email_dns" id="email_dns" />
          <select name="email_sel" id="email_sel" onchange="change_email()">
            <option value="">직접 입력</option>
            <option value="naver.com">NAVER</option>
            <option value="hanmail.net">DAUM</option>
            <option value="gmail.com">GOOGLE</option>
          </select>
        </p>

        <p>
          <label for="birth">생년월일</label>
          <input type="text" name="birth" id="birth" />
          <br />
          <span>* 8자리 숫자로 입력 ex) 20211022</span>
        </p>

        <p>
          <label for="adress"></label>
          <!-- <input type="text" name="adress" id="adress" size="5"> -->
          <button type="button" onclick="adress_search()">주소검색</button>
          <br />
          우편번호
          <input type="text" name="postalCode" id="postalCode" size="5" />
          <br />
          기본주소 <input type="text" name="addr1" id="addr1" size="30" />
          <br />
          상세주소 <input type="text" name="addr2" id="addr2" size="30" />
        </p>

        <p>
          <input type="checkbox" name="agree" id="agree" value="y" />
          <label for="agree">약관 동의</label>
        </p>

        <p>
          <button type="submit">회원가입</button>
          <button onclick="history.back()">이전으로</button>
          <button type="button" onclick="location.href='../index.php'">
            홈으로
          </button>
        </p>
      </fieldset>
    </form>
  </body>
</html>
