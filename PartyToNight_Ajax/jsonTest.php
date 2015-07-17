<?php
header('Access-Control-Allow-Origin: *');


//sendAjax로부터 넘어온 post 값 받기
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
@$seq = $request->seq;
//////////////////////////////

require_once('connect.php');
//쿼리문 작성
$query = "SELECT * FROM help_category where help_category_id=".$seq;

//쿼리 실행
$result = mysqli_query($conn, $query);


// 결과 값을 담을 변수 생성
$result_array = array();

// 루프를 통해 배열에 오브젝트를 하나씩 담는다.
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$result_array[] = $row;
};

// 결과값을 JSON 형식으로 변환한다.
$result_array = json_encode($result_array);

//결과값을 출력한다.
echo $result_array;

//데이터 사용을 종료
mysqli_free_result($result);

//mysql커넥트 종료
mysqli_close($conn);
?>