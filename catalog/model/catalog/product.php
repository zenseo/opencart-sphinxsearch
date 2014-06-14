<?php

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
