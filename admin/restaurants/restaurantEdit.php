<?php

include 'inc/adminSession.php';

$idx = $_GET['idx'];

include '../inc/dbcon.php';

$sql = "select * from restaurants where idx=$idx;";
$result = mysqli_query($dbcon, $sql);

$array = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <style>
        input[type=checkbox]{width:24px;height:24px}
        span{font-size: 14px; color: black; margin-left:10px;}
    </style>
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style/restaurantEdit.css">
    <script type="text/javascript">
			function edit_check(){
				var restaurantName = document.querySelector("#restaurantName");
				var instaId = document.querySelector("#instaId");
				if(restaurantName.value == ""){
					alert("식당 이름을 입력해주세요.")
					restaurantName.focus();
					return false;
				};
				if(instaId.value == ""){
					alert("Instagram ID를 입력해주세요.")
					instaId.focus();
					return false;
				}
			}
        function del_check(){
            var i = confirm("정말 삭제하시겠습니까? 삭제한 식당은 지도에 나타나지 않습니다.");
            if(i == true){
                location.href = "restaurantDelete.php?idx=<?php echo $idx; ?>"
            };
        };
    </script>
</head>
<body style="overflow-x:hidden; overflow-y:auto;">
<header>
    <div class="header">
        <div class="logo">
        <h1 class="tasty"><a href="https://localhost/tasty/index.php" style="color:#38a69b; margin-bottom:10px;">Tasty</a></h1>
        </div>
        <div class="menu">
        <ul>
            <p id="hello">
            <?php echo $s_name; ?>님 &nbsp어서오세요
            <li class="logout"><a href="../login/logout.php">로그아웃</a></li>
            <li class="members"><a href="../members/members.php">멤버</a></li>
            <?php if ($s_id == 'admin') { ?>
            <li class="admin"><a href="admin.php">관리자</a></li>
            <?php } ?>
            <li class="intro"><a href="../intro.php">소개</a></li>
            </p>
        </ul>
        </div>
    </div>
	</header>
	<form name="edit_form" action="restaurantEditCheck.php" method="post" onsubmit="return edit_check()">
        <fieldset>
					<legend>식당 정보 수정</legend>
					<input type="hidden" name="idx" value="<?php echo $idx; ?>" class="form-check">
					<p>
						<label for="restaurantName">식당 이름</label>
						<input type="text" name="restaurantName" id="restaurantName" value="<?php echo $array[
          'restaurantName'
      ]; ?>">
						<span class="err_restaurantName"></span>
					</p>

            <p>
                <span class="txt">카테고리</span>
								<select name="categori" id="categori" class="form-select" aria-label="Default select example">
        <div class="options">
            <option value="한식">한식</option>
            <option value="중식">중식</option>
            <option value="일식">일식</option>
            <option value="양식">양식</option>
            <option value="분식">분식</option>
            <option value="스시">스시</option>
            <option value="회">회</option>
        </div>
        </select>
            </p>

            <p style="margin-top:10px;">
                <label for="instaId">Instagram ID</label>
                <input type="text" name="instaId" id="instaId" value="<?php echo $array[
                    'instaId'
                ]; ?>"
                <br>
                <span class="err_instaId"></span>
							</p>
							<span style="color:#38a69b; width:200px;">우편번호가 비어있더라도 정보 수정은 가능합니다.<br> &nbsp&nbsp 주소를 바꾸실 경우에만 우편번호 찾기를 눌러주세요.</span>
							
            <div class="search">
                <div class="input-group mb-3">
                    <label for="address"></label>
                    <input type="text" name="postcode" id="postcode" placeholder="우편번호" readonly class="form-control" aria-label="우편번호" aria-describedby="basic-addon2" />
                    <div class="input-group-append"></div>
                    <input type="button" onclick="execDaumPostcode()" value="우편번호 찾기" class="btn btn-outline-secondary"/>
                </div>
        </div>

        <label for="address"></label>
        <input style="width:307px; margin-bottom:10px;" type="text" name="address" id="address" value="<?php echo $array[
            'addr1'
        ]; ?>" readonly/><br />
        <label for="detailAddress"></label>
        <input style="width:150px; " type="text" name="detailAddress" id="detailAddress" value="<?php echo $array[
            'addr2'
        ]; ?>" />
        <label for="extraAddress"></label>
        <input style="width:150px;" type="text" name="extraAddress" id="extraAddress" placeholder="참고항목(자동 기입)" readonly/>
        </p>
        <div
    id="layer"
    style="
        display: none;
        position: fixed;
        overflow: hidden;
        z-index: 3;
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
            <p>
                <button type="button" onclick="history.back()" class="btn">이전으로</button>
                <button type="submit" class="btn">정보 수정</button>
                <button type="button" onclick="location.href='../index.php'" class="btn">홈으로</button>
                <button type="button" onclick="del_check()" class="btn">식당 삭제</button>
            </p>

        </fieldset>
    </form>
    
</body>
</html>