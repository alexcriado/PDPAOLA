<template>
<div id="transactions">
    <h2>Transactions</h2>
    <div class="row">
       <Transaction v-for="transaction in transactions" :transaction="transaction" :key="transaction.id"></Transaction>
    </div>
</div>
</template>

<script>
    import Transaction from './Transaction.vue'
    import { mapState } from 'vuex'
    import {useStore} from "vuex";

    export default{
        // eslint-disable-next-line vue/multi-word-component-names
        name: 'transactions',
        components: {
            Transaction
        },
        setup() {
            const store = useStore();
            store.dispatch('getTransactions');
        },
        computed: {
            // mix the getters into computed with object spread operator
            ...mapState(['transactions'])
        },
        data(){
            return{

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