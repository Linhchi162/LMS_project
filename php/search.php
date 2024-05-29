<?php
function search_books($keyword)
{
        $data = [
            'query' => [
                'match' => [
                    'title' => $keyword
                ]
                ],
                'size' => 25
        ];
        $jsonData = json_encode($data);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:9200/book_detail/book/_search");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));


    // Thực hiện truy vấn và lấy kết quả
    $response = curl_exec($ch);

    // Kiểm tra lỗi
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        exit;
    }

    // Giải mã kết quả JSON
    $result = json_decode($response, true);

    // Mảng lưu trữ kết quả cuối cùng
    $data = array();

    // Lặp qua danh sách các tài liệu được trả về
    if (isset($result['hits']['hits']) && !empty($result['hits']['hits'])) {
        // Lặp qua danh sách các tài liệu được trả về
        foreach ($result['hits']['hits'] as $hit) {
            $source = $hit['_source'];

            // Tạo một mảng dữ liệu cho mỗi tài liệu
            $item = array(
                'id' => $source['id'],
                'name' => $source['title'],
                //'author' => $source['publisher'],
                'imageSrc' => $source['image']
            );

            // Thêm mảng dữ liệu này vào mảng kết quả cuối cùng
            $data[] = $item;
        }
    }

    // Đóng kết nối cURL
    curl_close($ch);

    // Trả về mảng kết quả
    return $data;
}


// Kiểm tra xem dữ liệu đã được gửi từ form chưa
if (isset($_POST['searchData'])) {
    // Lấy từ khóa tìm kiếm từ dữ liệu POST
    $keyword = $_POST['searchData'];

    // Gọi hàm search_books để tìm kiếm và trả về kết quả
    $searchResult = search_books($keyword);

    // Trả về kết quả tìm kiếm dưới dạng JSON
    echo json_encode($searchResult);
}
?>
