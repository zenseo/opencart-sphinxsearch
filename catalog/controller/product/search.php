<?php

    // ...
    
    $sphinx_product_ids = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_tag'])) {

      if (isset($this->request->get['filter_tag'])) {
          $search = $this->request->get['filter_tag'];
      }
      if (isset($this->request->get['filter_name'])) {
          $search = $this->request->get['filter_name'];
      }
			$search = $this->sphinx->EscapeString($search);

	    $search = "({$search} | *{$search})*";
			$sphinx_result = $this->sphinx->Query($search);

			 if ($sphinx_result !== false && !empty($sphinx_result['matches'])) { // если есть результаты поиска - обрабатываем их
          foreach ($sphinx_result['matches'] as $sphinx_product_id => $info) {
              $sphinx_product_ids[] = $sphinx_product_id;
          }


          $data = array(
              'product_ids'         => $sphinx_product_ids,
              // ...
          );

          $product_total = $this->model_catalog_product->getTotalProducts($data);

          $results = $this->model_catalog_product->getProducts($data);
          
          // ...
        }
