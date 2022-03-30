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
    <link rel="stylesheet" href="style/index.css">
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
          <option value="">카테고리</option>
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

        </script>
        
        <script>
        // 마커를 표시할 위치와 title 객체 배열입니다

        //마커를 담을 배열
			var positions = [];

//num_rows()의 수만큼 각 행의 정보를 가져와서 마커에 정보를 담기
  <?php
    $query = "select R.* from restaurants R";
    
    $result = mysqli_query($dbcon,$query);
    while($row = mysqli_fetch_assoc($result)){

      $test[] = $row; 
      echo 'var positions = ' . json_encode($test) . ';';
    };
    

?>


var markers = [];
for(i = 0; i < positions.length; i++){
  var loc = positions[i].location;
  var [lat, lng] = loc.split(',');
  lat = Number(lat);
  lng = Number(lng);
  
  var marker = {
    index : positions[i].idx,
    title : positions[i].restaurantName,
    latlng : new kakao.maps.LatLng(lat, lng),
  content : '<div class="overlaybox">' +
  '    <div class="boxtitle">'+positions[i].restaurantName+'</div>' +
  '    <div class="first">' +
  '        <div class="triangle"></div>' +
  '        <div class="categori">'+positions[i].categori+'</div>' +
  '    </div>' +
  '    <div class="instaId">'+positions[i].instaId+'</div>' +
  '    <ul class="information">' +
  '        <li class="address">' +
  '            <div class="addr">주소</div>' +
  '            <div class="addr1">'+positions[i].addr1+'</div>' +
  '            <div class="addr2">'+positions[i].addr2+'</div>' +
  '        </li>' +
  '        <li class="review">' +
  '            <div class="review1">한줄평</div>' +
  '            <div class="review2">'+positions[i].review+'</div>' +
  '        </li>' +
  '    </ul>' +
  '</div>'
};
  markers.push(marker);
}
console.log(markers);


        var imageSrc = "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";
        // 마커 이미지의 이미지 주소입니다
        
        
        </script>
    
    <script>
        //카테고리를 이용해서 마커 분류하기
        let createdMarker = [];

        function categorize(){
          const selectedCategori = document.querySelector(".selectCategori");
          const idx = selectedCategori.options.selectedIndex;
          const selectedValue = selectedCategori.options[idx].value;
          const categori = document.querySelector(".categori")
          
          for(var i = 0; i<createdMarker.length; i++){
            createdMarker[i].setMap(null);
          }
          
          //카테고리가 일치하는 마커만 다시 재생성
          for(var i = 0; i < markers.length; i++){
            const trueOrNot = markers[i].content.includes(selectedValue);
            // 마커 이미지의 이미지 크기 입니다
        var imageSize = new kakao.maps.Size(24, 35);

        // 마커 이미지를 생성합니다
        var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);

        // 마커를 생성합니다
        var marker = new kakao.maps.Marker({
          map: map, // 마커를 표시할 지도
          position: markers[i].latlng, // 마커를 표시할 위치
          title : markers[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
        image : markerImage, // 마커 이미지
      });
      var customOverlay = new kakao.maps.CustomOverlay({
        position: markers[i].latlng,
        content: markers[i].content,
        clickable: true,
        xAnchor: 0.3,
        yAnchor: 0.91
      });
      marker.setMap(null);
      if(trueOrNot == true){
        marker.setMap(map);
        createdMarker.push(marker);
      }
        
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
          }
        }
        console.log(markers);
      </script>
    </main>

    <footer></footer>
  </body>
</html>
