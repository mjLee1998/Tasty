<?php

include "../inc/admin_session.php";

$u_idx = $_GET["u_idx"];

include "../inc/dbcon.php";

$sql = "select * from members where idx=$u_idx;";
$result = mysqli_query($dbcon,$sql);

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
        body,input,select,option,button{font-size:24px}
        input[type=checkbox]{width:24px;height:24px}
        span{font-size: 14px; color: red;}
    </style>
    <script type="text/javascript">
        function edit_check (){
            var pwd = document.getElementById("pwd");
            var repwd = document.getElementById("repwd");

            if(pwd.value && pwd.value.length < 4 || pwd.value.length > 8){
                    alert("비밀번호는 4~8글자만 입력할 수 있습니다.");
                    pwd.focus();
                    return false;
                };

            if(pwd.value != pwd.value){
                alert("비밀번호를 확인해주세요.");
                pwd.focus();
                return false;
            };

            return true;
        };
        function change_email(){
            var email_dns = document.getElementById("email_dns");
            var email_sel = document.getElementById("email_sel");
            var idx = email_sel.options.selectedIndex;
            var sel_value = email_sel.options[idx].value;
            email_dns.value = sel_value;
        };
        function adress_search(){
            window.open("../../members/search_adress.php","","width=600px, height=250px, left=0, top=0")
        };
        function del_check(){
            var i = confirm("정말 삭제하시겠습니까? 삭제한 아이디는 사용하실 수 없습니다.");
            if(i == true){
                location.href = "delete.php?u_idx=<?php echo $u_idx; ?>"
            }; 
        };
    </script>
</head>
<body>
    <form name="edit_form" action="edit_check.php" method="post" onsubmit="return edit_check()">
        <fieldset>
            <legend>회원정보 수정</legend>
            <input type="hidden" name="u_idx" value="<?php echo $u_idx;?>">
            <p>
                <span class="txt">이름</span>
                <?php echo $array["u_name"]?>
            </p>

            <p>
                <span class="txt">아이디</span>
                <?php echo $array["u_id"]; ?>
            </p>

            <p>
                <label for="pwd">비밀번호</label>
                <!-- <input type="password" name="pwd" id="pwd"> -->
                <input type="password" name="pwd" id="pwd">
                <span>비워둘 경우 비밀번호가 변경되지 않음</span>
                <br>
                <span class="err_pwd"></span>
            </p>
            
            <p>
                <label for="repwd">비밀번호 확인</label>
                <!-- <input type="password" name="repwd" id="repwd"> -->
                <input type="password" name="repwd" id="repwd">
                <br>
                <span class="err_pwd"></span>
            </p>

            <p>
                <label for="mobile">전화번호</label>
                <input type="text" name="mobile" id="mobile" value="<?php echo $array["mobile"]?>">
                <br>
                <span class="err_mobile">"-" 없이 숫자만 입력</span>
            </p>

            
            <?php
            
            $birth = str_replace("-", "", $array["birth"]);
            
            ?>
            <p>
                <label for="birth">생년월일</label>
                <input type="text" name="birth" id="birth" value="<?php echo $birth; ?>">
                <br>
                <span>* 8자리 숫자로 입력 ex) 20211022</span>
            </p>

            <?php

            $email = explode("@", $array["email"]);

            ?>

            <p>
                <label for="email">이메일</label>
                <input type="text" name="email_id" id="email_id" value="<?php echo $email[0]?>"> @ 
                <input type="text" name="email_dns" id="email_dns" value="<?php echo $email[1]?>"> 
                <select name="email_sel" id="email_sel" onchange="change_email()">
                    <option value="">직접 입력</option>
                    <option value="naver.com">NAVER</option>
                    <option value="hanmail.net">DAUM</option>
                    <option value="gmail.com">GOOGLE</option>
                </select>
            </p>
						
            <p>
                <label for="adress">주소</label>
                <button type="button" onclick="adress_search()">주소검색</button>
                <br>
                우편번호 <input type="text" name="postalCode" id="postalCode" size="7" value="<?php echo $array["postalCode"];?>">
                <br>
                기본주소 <input type="text" name="addr1" id="addr1" size="30" value="<?php echo $array["addr1"];?>">
                <br>
                상세주소 <input type="text" name="addr2" id="addr2" size="30" value="<?php echo $array["addr2"];?>">
            </p>

            <p>
                <button type="button" onclick="history.back()">이전으로</button>
                <button type="submit">정보 수정</button>
                <button type="button" onclick="location.href='../admin.php'">홈으로</button>
                <button type="button" onclick="del_check()">회원 삭제</button>
            </p>

        </fieldset>
    </form>
</body>
</html>