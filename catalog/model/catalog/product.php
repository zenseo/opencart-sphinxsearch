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

# OR Without Controller Patch

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

              $search = $this->sphinx->EscapeString($search);

              $search = "({$search} | *{$search})*";
              $sphinx_result = $this->sphinx->Query($search);

              if ($sphinx_result !== false && !empty($sphinx_result['matches'])) {
                  foreach ($sphinx_result['matches'] as $sphinx_product_id => $info) {
                      $sphinx_product_ids[] = $sphinx_product_id;
                  }
              }

              if (count($sphinx_product_ids)) {
                  $sql .= " AND p.product_id IN (" . implode(',', $sphinx_product_ids) . ")";
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

              $search = $this->sphinx->EscapeString($search);

              $search = "({$search} | *{$search})*";
              $sphinx_result = $this->sphinx->Query($search);

              if ($sphinx_result !== false && !empty($sphinx_result['matches'])) {
                  foreach ($sphinx_result['matches'] as $sphinx_product_id => $info) {
                      $sphinx_product_ids[] = $sphinx_product_id;
                  }
              }

              if (count($sphinx_product_ids)) {
                  $sql .= " AND p.product_id IN (" . implode(',', $sphinx_product_ids) . ")";
              }
          }
    
    // ...
    
}
