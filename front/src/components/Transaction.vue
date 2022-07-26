<template>
<div id="transaction" class="row">
    <p>ID-Transaction: {{ transaction.id }} ID-Product: {{ transaction.product_id }} <strong>{{ transaction.type }}</strong>: Created:{{ transaction.created_at }} Last update: {{ transaction.updated_at }} <input type="button" value="CANCEL" @click="cancelTransaction()"></p>
    <br/>
</div>
</template>

<script>
    export default{
        // eslint-disable-next-line vue/multi-word-component-names
        name: 'transaction',
        props: {
            transaction: Object
        },
        data(){
            return{
                
            }
        },
        methods: {
            cancelTransaction(){
                this.$store.dispatch('deleteTransaction', this.transaction);
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