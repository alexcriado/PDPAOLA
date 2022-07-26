<template>
  <div class="row">
    <div class=col-8>
      <ProductList></ProductList>
    </div>
    <div class="col">
      <CreateProduct></CreateProduct>
    </div>
  </div>
  <div class="row">
    <Transactions></Transactions>
  </div>
</template>

<script>
import ProductList from './components/ProductList.vue'
import CreateProduct from './components/CreateProduct.vue'
import Transactions from './components/Transactions.vue'

export default {
  name: 'app',
  components: {
    ProductList,
    CreateProduct,
    Transactions
  }
}
</script>

<style>
  body {
    padding: 15px;
    background-color: whitesmoke;
  }

  #transactions {
    margin: 15px;
    padding: 0 50px;
  }

  #product-list,
  #transactions {
    border: 1px solid black;
    border-radius: 1%;
  }
</style>