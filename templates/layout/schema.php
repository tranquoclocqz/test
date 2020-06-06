<?php
include _lib."jsonLD.php";
// set default các tham số của json
$defaults = array(
  'title' => $row_setting['ten_' . $lang],
  'description' => $row_setting['description_' . $lang],
  'url' => $url_web,
  'type' => 'Webpage',
  'image' => $url_web . '/' . _upload_hinhanh_l . $logo['photo']
);
if ($template == 'product_detail') {
    // lấy hình ảnh kèm theo của sản phẩm
  $product_images = array_map(function ($hinhanh) {
    global $url_web;
    return $url_web . '/' . _upload_product_l . $hinhanh['photo'];
  }, $hinhanh_san_pham);
  $jsonLD = new jsonLD($defaults);
    /*
    Các phương thức gồm có:
        + setTtle
            $jsonLD->setTitle('Tiêu đề');
        + setType
            $jsonLD->setTitle('Type của Json'); // Article, Product, BreadcrumbList, Webpage
        + setUrl
            $jsonLD->setUrl('https://nina.vn');
        + setDescription
            $jsonLD->setDescription('Mô tả');
        + setImage => set 1 tấm hình
            $jsonLD->setImage(' Đường dẫn logo ');
        + setImages => set nhiều tấm hình, truyền 1 mảng gồm các đường dẫn hình ví dụ => lấy hình ảnh kèm theo của sản phẩm
            $jsonLD->setImages($product_images);
        + addValue // thêm 1 giá trị tùy biến gồm có key và value
            $jsonLD->addValue(' key ', ' value ');
        + addValues // thêm nhiều giá trị tùy biến gồm 1 mảng lớn các giá trị và biến, ví dụ ở bên dưới ( ** addValues ** )
    */
        $jsonLD->setType('Product');
        $jsonLD->setTitle($row_detail['ten_' . $lang]);
        $jsonLD->setDescription($row_detail['mota_' . $lang]);
        $jsonLD->setUrl(getCurrentPageURL());
        if (!empty($product_images)) {
          $product_images[] = $url_web."/"._upload_product_l.$row_detail['photo'];
          $jsonLD->setImages($product_images);
        } else {
          $jsonLD->setImage($url_web."/"._upload_product_l.$row_detail['photo']);    
        }

        if (!empty($row_detail['masp'])) {
          $jsonLD->addValues( array('sku'=>$row_detail['masp']) );
        }


        if ($row_detail['giaban'] != 0 && $row_detail['giacu'] != 0) {
          /** addValues **/
          $jsonLD->addValues(
            array(
              'offers' => array(
                "@type" => "AggregateOffer",
                "url" => getCurrentPageURL(), 
                'priceCurrency' => 'VND', 
                'highPrice' => $row_detail['giacu'], 
                'lowPrice' => $row_detail['giaban'], 
                'availability' => "https://schema.org/InStock"
              )
            )
          );
        } elseif ($row_detail['giaban'] != 0 && $row_detail['giacu'] == 0) {
          $jsonLD->addValues(
            array(
              'offers' => 
              array(
                "@type" => "Offer", 
                "url" => getCurrentPageURL(), 
                'priceCurrency' => 'VND', 
                'price' => $row_detail['giaban'], 
                'availability' => "https://schema.org/InStock"
              )
            )
          );
        }

        echo $jsonLD->generator();

      }

      if ($template == 'news_detail') {

        $article_images = array_map(function ($hinhanhs) {
          global $url_web;
          return $url_web . '/' . _upload_baiviet_l . $hinhanhs['photo'];
        }, $hinhanh);

        $jsonLD = new jsonLD($defaults);
        $jsonLD->setType('Article');
        $jsonLD->setTitle($row_detail['ten_' . $lang]);
        $jsonLD->setDescription($row_detail['mota_' . $lang]);
        $jsonLD->setUrl(getCurrentPageURL());

        $jsonLD->addValues(
          array('mainEntityOfPage' => array("@type" => "WebPage", "@id" => getCurrentPageURL()))
        );

        $jsonLD->addValue('headline', $row_detail['title_' . $lang]);
        $jsonLD->addValue('datePublished', date('c', $row_detail['ngaytao']));
        if ($row_detail['ngaysua'] != 0) {
          $jsonLD->addValue('dateModified', date('c', $row_detail['ngaysua']));
        }
        $jsonLD->addValues(
          array('author' => array("@type" => "Person", "name" => $row_setting['ten_' . $lang]))
        );
        if (!empty($article_images)) {
          $jsonLD->setImages($article_images);
        } else {
          $jsonLD->setImage($url_web . "/" . _upload_baiviet_l . $row_detail['photo']);
        }
        $jsonLD->addValues(
          array(
            'publisher' => array(
              "@type" => 'Organization',
              'name' => $row_setting['ten_' . $lang],
              'logo' => array(
                "@type" => 'ImageObject',
                'url' => $url_web . "/" . _upload_hinhanh_l . $logo['photo']
              )
            )
          )
        );
        echo $jsonLD->generator();
      }
      $array_social = array();
      $social = _result_array("SELECT url from table_lkweb");
      foreach ($social as $key => $value) {
        if (!filter_var($value['url'], FILTER_VALIDATE_URL) === FALSE) {
          $array_social[] = $value['url'];
        }
      }
      $jsonLD = new jsonLD($defaults);
      if (!empty($array_social)) {
        $jsonLD->addValues(
          array('sameAs' => $array_social)
        );
      }
      $address = array(
        'address' => array(
          '@type' => 'PostalAddress',
          'addressLocality' => 'Ho Chi Minh',
          'addressRegion' => 'VietNam',
          'postalCode' => '70000'
        )
      );
      $jsonLD->addValues($address);
      $jsonLD->addValues(
        array(
          'potentialAction' => array(
            '@type' => 'SearchAction',
            'target' => "" . $url_web . "/tim-kiem/&keywords={search_term_string}",
            "query-input" => "required name=search_term_string"
          )
        )
      );
      echo $jsonLD->generator();