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
        color: #38a69b;
        margin-left:10px;
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
      function address_search() {
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
          <select name="email_sel" id="email_sel" onchange="change_email()"class="form-select" aria-label="Default select example">
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

        <label for="postcode"></label>
        <div class="input-group mb-3">
        <input type="text" name="postcode" id="postcode" placeholder="우편번호" readonly class="form-control" aria-label="우편번호" aria-describedby="basic-addon2"/>
        <div class="input-group-append"></div>
        <input type="button" onclick="execDaumPostcode()" value="우편번호 찾기" class="btn btn-outline-secondary"/>
      </div>
      <p>
        <label for="address"></label>
        <input style="width:307px; margin-bottom:10px;" type="text" name="address" id="address" placeholder="주소(자동 기입)" readonly/><br />
        <label for="detailAddress"></label>
        <input style="width:150px; " type="text" name="detailAddress" id="detailAddress" placeholder="상세주소(필수)" />
        <label for="extraAddress"></label>
        <input style="width:150px;" type="text" name="extraAddress" id="extraAddress" placeholder="참고항목(자동 기입)" readonly/>
      </p>
        <div
    id="layer"
    style="
        display: none;
        position: fixed;
        overflow: hidden;
        z-index: 1;
        -webkit-overflow-scrolling: touch;
        "
    >
    <img
    src="//t1.daumcdn.net/postcode/resource/images/close.png"
    id="btnCloseLayer"
    style="
          cursor: pointer;
          position: absolute;
          right: -3px;
          top: -3px;
          z-index: 1;
          "
        onclick="closeDaumPostcode()"
        alt="닫기 버튼"
        />
      </div>
      
      <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

        <p class="agree">
          <input type="checkbox" name="agree" id="agree" value="y" />
          <label for="agree">약관 동의</label>
        </p>

        <p class="buttons">
          <button type="submit">회원가입</button>
          <button onclick="history.back()">이전으로</button>
          <button type="button" onclick="location.href='../index.php'">
            홈으로
          </button>
        </p>
      </fieldset>
    </form>
    <script>
  // 우편번호 찾기 화면을 넣을 element
  var element_layer = document.getElementById("layer");
  
  function closeDaumPostcode() {
    // iframe을 넣은 element를 안보이게 한다.
        element_layer.style.display = "none";
      }
      
      function execDaumPostcode() {
        new daum.Postcode({
          oncomplete: function (data) {
            // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
            
            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ""; // 주소 변수
            var extraAddr = ""; // 참고항목 변수
            
            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === "R") {
              // 사용자가 도로명 주소를 선택했을 경우
              addr = data.roadAddress;
            } else {
              // 사용자가 지번 주소를 선택했을 경우(J)
              addr = data.jibunAddress;
            }
            
            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if (data.userSelectedType === "R") {
              // 법정동명이 있을 경우 추가한다. (법정리는 제외)
              // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
              if (data.bname !== "" && /[동|로|가]$/g.test(data.bname)) {
                extraAddr += data.bname;
              }
              // 건물명이 있고, 공동주택일 경우 추가한다.
              if (data.buildingName !== "" && data.apartment === "Y") {
                extraAddr +=
                extraAddr !== ""
                ? ", " + data.buildingName
                : data.buildingName;
              }
              // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
              if (extraAddr !== "") {
                extraAddr = " (" + extraAddr + ")";
              }
              // 조합된 참고항목을 해당 필드에 넣는다.
              document.getElementById("extraAddress").value = extraAddr;
            } else {
              document.getElementById("extraAddress").value = "";
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById("postcode").value = data.zonecode;
            document.getElementById("address").value = addr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("detailAddress").focus();

            // iframe을 넣은 element를 안보이게 한다.
            // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
            element_layer.style.display = "none";

            console.log(data.address);

          },
          width: "100%",
          height: "100%",
          maxSuggestItems: 5,
        }).embed(element_layer);

        // iframe을 넣은 element를 보이게 한다.
        element_layer.style.display = "block";

        // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
        initLayerPosition();
      }

      // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
      // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
      // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
      function initLayerPosition() {
        var width = 300; //우편번호서비스가 들어갈 element의 width
        var height = 400; //우편번호서비스가 들어갈 element의 height
        var borderWidth = 5; //샘플에서 사용하는 border의 두께

        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + "px";
        element_layer.style.height = height + "px";
        element_layer.style.border = borderWidth + "px solid";
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
        element_layer.style.left =
          ((window.innerWidth || document.documentElement.clientWidth) -
            width) /
            2 -
          borderWidth +
          "px";
        element_layer.style.top =
          ((window.innerHeight || document.documentElement.clientHeight) -
            height) /
            2 -
          borderWidth +
          "px";
      }
    </script>
  </body>
</html>
