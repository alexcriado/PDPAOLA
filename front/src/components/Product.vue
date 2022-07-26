<template>
<div id="product">
    <div class="col mb-4">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">{{product.name}}</h5>
            <p class="card-text">
                ID: {{ product.id }}
                <br/>
                Price: {{product.price}}€
                <br/>
                <small>
                    Description: {{product.description}}
                </small>
                <br/>
                <small>
                    Stock: {{ product.stock }}
                </small>
            </p>
            <input type="button" value="BUY" v-if="product.stock > 0" @click="buyProduct">
            <input type="button" value="SELL" @click="sellProduct">
            <br/>
            <input style="margin-top: 5px;" type="button" value="DELETE" @click="deleteProduct">
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default{
        // eslint-disable-next-line vue/multi-word-component-names
        name: 'product',
        props: {
            product: Object
        },
        data(){
            return{
                
            }
        },
        methods: {
            deleteProduct() {
                this.$store.dispatch('deleteProduct', this.product.id);
            },
            buyProduct() {
                this.$store.dispatch('buyProduct', this.product);
            },
            sellProduct() {
                this.$store.dispatch('sellProduct', this.product);
            },
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