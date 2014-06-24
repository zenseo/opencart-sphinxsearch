<?php

# Controller Patch Required

public function getProducts(array $data = array()) {

    // ...
    
    if (isset($data['product_ids']) && count($data['product_ids'])) {
        $sql .= " AND p.product_id IN (" . implode(',', $data['product_ids']) . ")";
    }
    
    // ...
    
}

public function getTotalProducts(array $data = array()) {

    // ...
    
    if (isset($data['product_ids']) && count($data['product_ids'])) {
        $sql .= " AND p.product_id IN (" . implode(',', $data['product_ids']) . ")";
    }
    
    // ...
    
}

# Without Controller Patch

public function getProducts(array $data = array()) {

    // ...
    
        if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {

              $sphinx_product_ids = array();

              if (isset($data['filter_tag'])) {
                  $search = $data['filter_tag'];
              }

              if (isset($data['filter_name'])) {
                  $search = $data['filter_name'];
              }

              $search = trim($this->sphinx->EscapeString($search));

              $to_transliteration = $this->_transliteration($search, 'to');
              $from_transliteration = $this->_transliteration($search, 'from');

              $search = "({$search} | *{$search}* | {$to_transliteration} | *{$to_transliteration}* | {$from_transliteration} | *{$from_transliteration}*)";
              $sphinx_result = $this->sphinx->Query($search);

              if ($sphinx_result !== false && !empty($sphinx_result['matches'])) {
                  foreach ($sphinx_result['matches'] as $sphinx_product_id => $info) {
                      $sphinx_product_ids[] = $sphinx_product_id;
                  }
              }

              if (count($sphinx_product_ids)) {
                  $sql .= " AND p.product_id IN (" . implode(',', $sphinx_product_ids) . ")";
              } else {
                  $sql .= " AND p.product_id = 0";
              }
          }
    
    // ...
    
}

public function getTotalProducts(array $data = array()) {

    // ...
    
        if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {

              $sphinx_product_ids = array();

              if (isset($data['filter_tag'])) {
                  $search = $data['filter_tag'];
              }

              if (isset($data['filter_name'])) {
                  $search = $data['filter_name'];
              }

              $search = trim($this->sphinx->EscapeString($search));

              $to_transliteration = $this->_transliteration($search, 'to');
              $from_transliteration = $this->_transliteration($search, 'from');

              $search = "({$search} | *{$search}* | {$to_transliteration} | *{$to_transliteration}* | {$from_transliteration} | *{$from_transliteration}*)";
              $sphinx_result = $this->sphinx->Query($search);

              if ($sphinx_result !== false && !empty($sphinx_result['matches'])) {
                  foreach ($sphinx_result['matches'] as $sphinx_product_id => $info) {
                      $sphinx_product_ids[] = $sphinx_product_id;
                  }
              }

              if (count($sphinx_product_ids)) {
                  $sql .= " AND p.product_id IN (" . implode(',', $sphinx_product_ids) . ")";
              } else {
                  $sql .= " AND p.product_id = 0";
              }
          }
    
    // ...
    
    
    private function _transliteration($string, $stream = 'to') {

        $converter = array(

            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

            'и' => 'i',   'й' => 'y',   'к' => 'k',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'h',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'і' => 'i',   'ї' => 'yi',  'ґ' => 'g',



            'А' => 'A',   'Б' => 'B',   'В' => 'V',

            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

            'И' => 'I',   'Й' => 'Y',   'К' => 'K',

            'Л' => 'L',   'М' => 'M',   'Н' => 'N',

            'О' => 'O',   'П' => 'P',   'Р' => 'R',

            'С' => 'S',   'Т' => 'T',   'У' => 'U',

            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

            'І' => 'I',   'Ї' => 'Yi',  'Ґ' => 'G',

        );

        if ($stream == 'to') {
            return strtr($string, $converter);
        } else {
            return strtr($string, array_flip($converter));
        }

    }
    
}
