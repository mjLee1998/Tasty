<?php

session_start();

$s_id = isset($_SESSION["s_id"])? $_SESSION["s_id"]:"";
$s_name = isset($_SESSION["s_name"])? $_SESSION["s_name"]:"";
// echo "session ID : ".$s_id."/ name : ".$s_name;



include"./inc/dbcon.php";
// echo $sql;

//DB에서 값 가져오기
echo "안녕하세요 ".$s_id."님"."<br>"."<br>"."주소를 검색하여 선택하실 때, 도로명 주소를 선택하여 주세요."."<br><br>";
//table restaurant 변수

// mysqli_close($dbcon);



?>



<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>식당 등록</title>

    <style type="text/css">
      html,body,div,span,iframe,h1,h2,h3,h4,h5,h6,p,a,address,ul,li,fieldset,form,label,legend,footer,header,nav{
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
      }
      /* HTML5 display-role reset for older browsers */
      article,
      aside,
      details,
      figcaption,
      figure,
      footer,
      header,
      hgroup,
      menu,
      nav,
      section {
        display: block;
      }
      body {
        line-height: 1;
      }
      ol,
      ul {
        list-style: none;
      }
      blockquote,
      q {
        quotes: none;
      }
      blockquote:before,
      blockquote:after,
      q:before,
      q:after {
        content: "";
        content: none;
      }
      table {
        border-collapse: collapse;
        border-spacing: 0;
      }
    </style>
    <style>
      body{
        font-size:14px;
        font-family:Helvetica;
      }
      #map{
        z-index:0;
      }
      #location{
        display:none;
      }
    </style>
  </head>
  <body>
    <a href="index.php">홈으로</a><br><br>
    <form name="addRestaurant_form" action="addRestaurantCheck.php" method="post" onsubmit="return a()">

    <fieldset>
      <legend>식당 등록</legend><br>
      <p>
      <label for="postcode"></label>
        <input type="text" name="postcode" id="postcode" placeholder="우편번호" readonly />
        <input
        type="button"
        onclick="execDaumPostcode()"
        value="우편번호 찾기"
        /><br />
      </p>
      <p>
        <label for="address"></label>
        <input type="text" name="address" id="address" placeholder="주소" readonly/><br />
        <label for="detailAddress"></label>
        <input type="text" name="detailAddress" id="detailAddress" placeholder="상세주소" />
        <label for="extraAddress"></label>
        <input type="text" name="extraAddress" id="extraAddress" placeholder="참고항목" readonly/>
      </p>
        
      <p>
        <label for="restaurantName"></label>
        <input type="text" name="restaurantName" value="식당 이름"/>
        <label for="instaId"></label>
        <input type="text" name="instaId" value="Instagram 아이디"/>

        <label for="categori"></label>
        <select name="categori" id="categori">
          <option value="한식">한식</option>
          <option value="중식">중식</option>
          <option value="일식">일식</option>
          <option value="양식">양식</option>
          <option value="분식">분식</option>
          <option value="스시">스시</option>
          <option value="회">회</option>
        </select>
        
        <label for="review"></label>
        <input type="text" name="review" value="review">

        <label for="location"></label>
        <input type="text" name="location" id="location" value="">
      </p>
      
    </fieldset>

    <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
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

    <!-- 지도 파트 -->
    <div
      id="map"
      style="width: 300px; height: 300px; margin-top: 10px; display: none"
    ></div>

    <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=26fdf226a690f77f33e7a8f67ee40ac1&libraries=services"></script>
    <div class="registerInfo">
      <button type="submit" id="regist">등록하기</button>
    </div>

    <script>
      var mapContainer = document.getElementById("map"), // 지도를 표시할 div
        mapOption = {
          center: new daum.maps.LatLng(37.537187, 127.005476), // 지도의 중심좌표
          level: 5, // 지도의 확대 레벨
        };

      //지도를 미리 생성
      var map = new daum.maps.Map(mapContainer, mapOption);
      //주소-좌표 변환 객체를 생성
      var geocoder = new daum.maps.services.Geocoder();
      //마커를 미리 생성
      var marker = new daum.maps.Marker({
        position: new daum.maps.LatLng(37.537187, 127.005476),
        map: map,
      });

      
    </script>


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

            // 지도 파트
            // var addr1 = data.address; // 최종 주소 변수

            // // 주소 정보를 해당 필드에 넣는다.
            // document.getElementById("address").value = addr1;
            // 주소로 상세 정보를 검색
            geocoder.addressSearch(data.address, function (results, status) {
              // 정상적으로 검색이 완료됐으면
              if (status === daum.maps.services.Status.OK) {
                var result = results[0]; //첫번째 결과의 값을 활용

                // 해당 주소에 대한 좌표를 받아서
                var coords = new daum.maps.LatLng(result.y, result.x);
                // 지도를 보여준다.
                mapContainer.style.display = "block";
                map.relayout();
                // 지도 중심을 변경한다.
                map.setCenter(coords);
                // 마커를 결과값으로 받은 위치로 옮긴다.
                marker.setPosition(coords);

                // 지도의 중심 좌표 가져오기
                const latlng = map.getCenter();

                const lat = latlng.getLat();
                const lng = latlng.getLng();

                const location = lat+","+lng;
                const locValue =  document.querySelector("#location");
                locValue.value = location;
              }
            });
            // 지도 파트 끝
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
