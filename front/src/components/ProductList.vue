<template>
    <div id="product-list">
            <input id="input-search" type="text" class="form-control" v-model="textSearch" placeholder='Search...'>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
            <Product v-for="product in productsFilter" :product="product" :key="product.id" />
        </div>  
        <p class="no-links-msg" v-if="!products.length">No Products!</p>
    </div>
</template>

<script>
    import Product from './Product.vue'
    import { mapState } from 'vuex'
    import {useStore} from "vuex";

    export default{
        name: 'product-list',
        components: {
            Product
        },
        setup() {
            const store = useStore();
            store.dispatch('getProducts');
        },
        computed: {
            // mix the getters into computed with object spread operator
            ...mapState(['products']),

            productsFilter: function() {
            var textSearch = this.textSearch;
            return this.products.filter(function(el) {
                return el.name.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1;
            });
            }
        },
        data(){
            return{
                textSearch: "",
            }
        }
    }
</script>
