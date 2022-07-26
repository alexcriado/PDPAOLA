<template>
<div id="product">
    <input type="text" v-model="newProduct.name" placeholder="Nombre">
    <input type="text" v-model="newProduct.description" placeholder="Description">
    <input type="number" v-model="newProduct.price" placeholder="Price">
    <input type="number" v-model="newProduct.stock" placeholder="Stock">
    <input type="button" value="CREATE" @click="createProduct">
</div>
</template>

<script>
    export default{
        // eslint-disable-next-line vue/multi-word-component-names
        name: 'create-product',
        data(){
            return{
                newProduct: {
                    name: '',
                    description: '',
                    price: null,
                    stock: null
                }
            }
        },
        methods: {
            createProduct() {
                this.$store.dispatch('createProduct', this.newProduct);
            }
        }
    }
</script>

<style lang="css">
    .box-link {
    margin-top: 10px;
    }

    p {
        margin-top: 0;
    }
    
    .description-link {
        margin-bottom: 10px;
    }
</style>
