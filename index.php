<?php

session_start();

$s_id = isset($_SESSION["s_id"])? $_SESSION["s_id"]:"";
$s_name = isset($_SESSION["s_name"])? $_SESSION["s_name"]:"";
// echo "session ID : ".$s_id."/ name : ".$s_name;



include"./inc/dbcon.php";
$sql = "select * from restaurants where idx= 1;";
// echo $sql;

//DB에서 값 가져오기
$result = mysqli_query($dbcon,$sql);
$row = mysqli_fetch_assoc($result);

//table restaurant 변수

// mysqli_close($dbcon);



?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tasty</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <style type="text/css">
      /* 기본 세팅 및 폰트 설정 */
      body,
      input,
      select{
        font-size: 24px;
      }
      a{
        text-decoration:none;
      }
      a:visited{
        color:black;
      }
      @font-face {
        font-family: "TmonMonsori";
        src: url("https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_two@1.0/TmonMonsori.woff")
          format("woff");
        font-weight: normal;
        font-style: normal;
      }

      /* 헤더 로고 및 사이트맵 스타일 */
      .header a {
        text-decoration: none;
        color: black;
      }
      .header ul {
        padding-left: 0;
      }
      .header li {
        list-style: none;
      }
      .header ul {
        margin: 14px 0px;
      }
      input[type="checkbox"] {
        width: 24px;
        height: 24px;
      }
      span {
        font-size: 14px;
        color: red;
      }
      body {
        font-family: "TmonMonsori";
        font-size: 14px;
        margin: 0px 10px;
      }
      .header {
        border: 1px solid black;
        width: 380px;
        height: 70px;
        margin-top: 10px;
        margin-bottom: 20px;
      }
      .header .logo {
        width: 100px;
        height: 50px;
        margin-top: 8px;
        margin-left: 10px;
        float: left;
        background-image: url(./img/logo.png);
        background-repeat: no-repeat;
        background-size: cover;
      }
      #hello {
        margin-left: 5px;
      }
      .menu ul {
        width: 250px;
        height: 42px;
        margin-left: 109px;
      }
      .menu li {
        float: left;
        margin-top: 25px;
        margin-left: 10px;
      }
      #hello {
        position: absolute;
        left: 125px;
        top: 15px;
        margin-top: 14px;
      }
      
      /* 메인 메뉴 스타일 */
      .main_header {
        border: 1px solid black;
        width: 380px;
        height: 38px;
        margin-bottom: 20px;
      }
      .mainMenu1 {
        font-size: 14px;
        width: 100px;
        height: 38px;
        padding: 10px 10px 10px 0px;
        margin-left:20px;
        float:left;
      }
      .addRestaurant{
        padding-left:10px;
      }
      .mainMenu2 {
        font-size: 14px;
        width: 100px;
        height: 38px;
        padding: 10px 10px 10px 0px;
        margin-left:20px;
        float:left;
      }
      .groupSelect{
        padding-left:10px;
      }
      .mainMenu3 {
        font-size: 14px;
        width: 100px;
        height: 38px;
        padding: 10px 10px 10px 0px;
        margin:0px 0px 0px 20px;
        float:left;
      }
      .selectMember{
        padding-left: 10px;
      }
/*       
      .searchbar {
        border: 1px solid black;
        width: 380px;
        height: 38px;
        margin-bottom: 20px;
      } */
      .text {
        width: 180px;
        height: 38px;
      }
      #selectCategori{
        font-size:16px;
        margin-left:10px;
        width: 60px;
        height: 50px;
      }
      .searchButton {
        width: 100px;
        height: 38px;
        margin-left: 16px;
        margin-bottom: 20px;
        font-size:14px;
      }
      
      /* 지도 스타일 */
      #map {
        box-sizing:content-box;
        border: 3px solid black;
      }
      </style>


<!-- 오버레이 박스 css -->
<style>
  .overlaybox {
    font-family: "helvetica";
  }
  .overlaybox {
    position: relative;
    width: 150px;
    height: 180px;
    border-radius: 5%;
        position: absolute;
        top: -215px;
        left: -70px;
        background-color: rgb(61, 63, 74);
        padding: 15px 10px;
      }
      .overlaybox div,
      ul {
        margin: 0;
        padding: 0;
      }
      .overlaybox li {
        list-style: none;
      }
      .overlaybox .boxtitle {
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        text-align: right;
        margin-top: -8px;
        margin-right: 3px;
      }
      .categori {
        position: relative;
        width: 127px;
        height: 20px;
        text-align: right;
        font-size: 12px;
        color: #fff;
      }
      .overlaybox .instaId {
        color: #fff;
        font-weight: bold;
        font-size: 12px;
        position: absolute;
        top: 30px;
        left: 10px;
      }
      .first .triangle {
        position: absolute;
        top: 0;
        left: 0;
        width: 0px;
        height: 0px;
        border-bottom: 36px solid green;
        border-left: 0px solid transparent;
        border-right: 36px solid transparent;
        transform: rotate(90deg);
      }
      .overlaybox ul {
        width: 127px;
      }
      .overlaybox li {
        position: relative;
        margin-bottom: 6px;
        background: #2b2d36;
        padding: 5px 8px;
        color: #aaabaf;
        line-height: 1;
        border-radius: 5%;
      }
      .overlaybox li span {
        display: inline-block;
      }
      .overlaybox li .addr {
        font-size: 12px;
        font-weight: bold;
      }
      .overlaybox li .addr1 {
        font-size: 10px;
        white-space: normal;
      }
      .overlaybox li .addr2 {
        font-size: 10px;
      }
      .overlaybox .review {
        width: 127px;
        height: 70px;
        overflow: hidden;
        word-break: break-all;
      }
      .overlaybox .review:hover {
        overflow: visible;
      }
      .overlaybox li .review1 {
        font-size: 12px;
        font-weight: bold;
      }
      .overlaybox li .review2 {
        font-size: 10px;
        white-space: normal;
      }
      .overlaybox li:hover {
        color: #fff;
        background: #d24545;
        transform: scale(1.1);
      }
    </style>

    <script type="text/javascript"></script>
  </head>
  <body>
    <header>
      <div class="header">
        <div class="logo"></div>
        <div class="menu">
          <ul>
            <?php
					if(!$s_id){?>
            <li><a href="./login/login.php">로그인</a></li>
            <li><a href="./members/join.php">회원가입</a></li>
            <?php } else { ?>
            <p id="hello">
              <?php echo $s_name; ?>님, 안녕하세요.
              <li><a href="login/logout.php">로그아웃</a></li>
              <li><a href="members/members.php">멤버</a></li>
              <li><a href="members/edit.php">정보수정</a></li>
              <?php if($s_id == "admin"){ ?>
              <li><a href="admin/admin.php">관리자</a></li>
              <?php }; ?>
              <?php }; ?>
              <li><a href="intro.php">소개</a></li>
            </p>
          </ul>
        </div>
      </div>
    </header>

    <main>
      <div class="main_header">
        <?php
        if(!$s_id){?>
          <p>로그인을 해주세요.</p>
          <?php } else{ ?>
            <div class="mainMenu1">
              <div class="addRestaurant">
                <a href="addRestaurant.php">식당 추가</a>
              </div>
            </div>
            <div class="mainMenu2">
              <div class="selectGroup">
                그룹 별로 보기
              </div>
            </div>
            <div class="mainMenu3">
              <div class="selectMember">
                멤버별로 보기
              </div>
          <?php } ?>
        </div>
      </div>
      <!-- <div class="searchbar"></div> -->
      <div class="search">
        <input type="text" class="text" />
        <select name="selectCategori" id="selectCategori" class="selectCategori">
          <option value="한식">한식</option>
          <option value="중식">중식</option>
          <option value="일식">일식</option>
          <option value="양식">양식</option>
          <option value="분식">분식</option>
          <option value="스시">스시</option>
          <option value="회">회</option>
        </select>
        <button type="button" class="searchButton" onclick="categorize()">검색</button>
      </div>
      <div id="map" style="width: 380px; height: 480px"></div>
      <script
        type="text/javascript"
        src="//dapi.kakao.com/v2/maps/sdk.js?appkey=26fdf226a690f77f33e7a8f67ee40ac1"
      ></script>
      <script>
        var mapContainer = document.getElementById('map'), // 지도를 표시할 div
        mapOption = {
          center: new kakao.maps.LatLng(37.506888, 127.045361), // 지도의 중심좌표
          level: 9 // 지도의 확대 레벨
        };

        // 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
        var map = new kakao.maps.Map(mapContainer, mapOption);


        // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
        var zoomControl = new kakao.maps.ZoomControl();
        map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

        // 지도가 확대 또는 축소되면 마지막 파라미터로 넘어온 함수를 호출하도록 이벤트를 등록합니다
        kakao.maps.event.addListener(map, 'zoom_changed', function() {

        });


        //전역변수 정의(오버레이 1개만 띄우기)
        var clickedOverlay = null;


        // 마커를 표시할 위치와 title 객체 배열입니다

        var positions = [
          {
            index: 1,
            title: '올래곱창',
            latlng: new kakao.maps.LatLng(<?php echo $row["location"] ?>),
            content: '<div class="overlaybox">' +
            '    <div class="boxtitle"><?php echo $row["restaurantName"]?></div>' +
            '    <div class="first">' +
            '        <div class="triangle"></div>' +
            '        <div class="categori"><?php echo $row["categori"]?></div>' +
            '    </div>' +
            '    <div class="instaId"><?php echo $row["instaId"]?></div>' +
            '    <ul class="information">' +
            '        <li class="address">' +
            '            <div class="addr">주소</div>' +
            '            <div class="addr1"><?php echo $row["addr1"]?></div>' +
            '            <div class="addr2"><?php echo $row["addr2"]?></div>' +
            '        </li>' +
            '        <li class="review">' +
            '            <div class="review1">한줄평</div>' +
            '            <div class="review2"><?php echo $row["review"]?></div>' +
            '        </li>' +
            '    </ul>' +
            '</div>'
          },
          {
            index: 2,
            title: '아무데나',
            latlng: new kakao.maps.LatLng(37.541108, 127.084060),
            content: '<div class="overlaybox">' +
            '    <div class="boxtitle">아무데나</div>' +
            '    <div class="first">' +
            '        <div class="triangle"></div>' +
            '        <div class="categori">잡식</div>' +
            '    </div>' +
            '    <div class="instaId">@kwanidlfrk</div>' +
            '    <ul class="information">' +
            '        <li class="address">' +
            '            <div class="addr">주소</div>' +
            '            <div class="addr1">서울시 강남구 삼성동</div>' +
            '            <div class="addr2">대치동 909번지 1층 4호</div>' +
            '        </li>' +
            '        <li class="review">' +
            '            <div class="review1">한줄평</div>' +
            '            <div class="review2">가뭄의 단비같이 찾아온 대치동의 숨은 맛집</div>' +
            '        </li>' +
            '    </ul>' +
            '</div>'
          },
          {
            index: 3,
            title: '띵진이집',
            categori: "분식",
            latlng: new kakao.maps.LatLng(37.506888, 127.045361),
            content: '<div class="overlaybox">' +
            '    <div class="boxtitle">띵진이집</div>' +
            '    <div class="first">' +
            '        <div class="triangle"></div>' +
            '        <div class="categori">본진</div>' +
            '    </div>' +
            '    <div class="instaId">@thing_lmj</div>' +
            '    <ul class="information">' +
            '        <li class="address">' +
            '            <div class="addr">주소</div>' +
            '            <div class="addr1">서울시 강남구 역삼동</div>' +
            '            <div class="addr2">테헤란로 55길 46</div>' +
            '        </li>' +
            '        <li class="review">' +
            '            <div class="review1">한줄평</div>' +
            '            <div class="review2">천재가 사는 집</div>' +
            '        </li>' +
            '    </ul>' +
            '</div>'
          }
        ];

        // 마커 이미지의 이미지 주소입니다
        var imageSrc = "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";


        for (var i = 0; i < positions.length; i ++) {

        // 마커 이미지의 이미지 크기 입니다
        var imageSize = new kakao.maps.Size(24, 35);

        // 마커 이미지를 생성합니다
        var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);

        // 마커를 생성합니다
        var marker = new kakao.maps.Marker({
          map: map, // 마커를 표시할 지도
          position: positions[i].latlng, // 마커를 표시할 위치
          title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
          image : markerImage, // 마커 이미지
          categori : positions[i].categori
        });
        var customOverlay = new kakao.maps.CustomOverlay({
          position: positions[i].latlng,
          content: positions[i].content,
          clickable: true,
          xAnchor: 0.3,
          yAnchor: 0.91
        });
        
        
        // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
        // 이벤트 리스너로는 클로저를 만들어 등록합니다
        // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
        
        
        

        
        kakao.maps.event.addListener(marker, 'click', makeOverListener(map, marker, customOverlay));
        
        
        
        
        
        kakao.maps.event.addListener(map, 'click', function(mouseEvent) {
          if(clickedOverlay){
            clickedOverlay.setMap(null);
          };
        });
        
        
        
        function makeOverListener(map, marker, customOverlay) {
          return function() {
            if(clickedOverlay){
              clickedOverlay.setMap(null);
            }
            customOverlay.setMap(map);
            clickedOverlay = customOverlay;
            map.panTo(marker.getPosition());
          };
          
        }
        
        
        function makeOutListener(customOverlay) {
          return function() {
            customOverlay.setMap(null);
          };
        }
        console.log(customOverlay);
        console.log(marker);
        //for문 마지막
      }

      // 인포윈도우를 표시하는 클로저를 만드는 함수입니다
      </script>

      <script>
        //카테고리를 이용해서 마커 분류하기

        function categorize(){
          const selectedCategori = document.querySelector(".selectCategori");
          const idx = selectedCategori.options.selectedIndex;
          const selectedValue = selectedCategori.options[idx].value;

          const categori = document.querySelector(".categori")
          console.log(categori.innerText);
        }
      </script>
    </main>

    <footer></footer>
  </body>
</html>
