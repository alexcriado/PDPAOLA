import { createStore } from 'vuex'
import axios from 'axios'

const store = createStore({
    state: {
        products: [],
        transactions: []
    },
    getters: {
        products: state => {
            return state.products;
        },
        transactions: state => {
            return state.transactions;
        }
    },
    mutations: {
        ALLPRODUCTS(state, data) {
            state.products = Object.values(data.products)
        },
        ADDPRODUCT(state, data){
            state.products.push(data.newProduct);
        },
        DELETEPRODUCT(state, id){
            state.products = state.products.filter((product) => id != product.id);
        },
        UPDATEPRODUCTSTOCK(state, param){
            state.products = state.products.map(product => {
                if(parseInt(param.id) == parseInt(product.id)) {
                    if(param.action == 'buy'){
                        product.stock = product.stock - 1;
                    }else {
                        product.stock = product.stock + 1;
                    }
                }
                return product;
            });
        },
        ALLTRANSACTIONS(state, data){
            state.transactions = Object.values(data.transactions)
        },
        ADDTRANSACTION(state, data){
            state.transactions.push(data.transaction);
        },
        DELETETRANSACTION(state, id){
            state.transactions = state.transactions.filter((transaction) => id != transaction.id);
        },
    },
    actions: {
        getProducts(state) {
            axios.get('http://localhost:8000/v1/stock/list')
            .then(function (response) {
                state.commit('ALLPRODUCTS', {
                    products: response.data
                })
                console.log('LIST ALL PRODUCTS');
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        createProduct(state, newProduct){
            axios.post('http://localhost:8000/v1/stock/create', newProduct)
            .then(function () {
                state.commit('ADDPRODUCT', {
                    newProduct
                })
            console.log('CREATE PRODUCT');
            })
            .catch(function (error) {
                console.log(error);
            });
            //we can't see the transaction_id
            state.dispatch('getTransactions');
        },
        deleteProduct(state, id){
            axios.delete('http://localhost:8000/v1/stock/'+id)
            .then(function () {
                state.commit('DELETEPRODUCT', id);
                console.log('DELETE PRODUCT');
            })
            .catch(function (error) {
            console.log(error);
            });
        },
        buyProduct(state, product){
            //update stock product -1
            var updateParam = {
                name: product.name, 
                description: product.description,
                price: product.price, 
                stock: product.stock-1
            }
            axios.put('http://localhost:8000/v1/stock/'+product.id, updateParam)
            .then(function () {
                state.commit('UPDATEPRODUCTSTOCK', {
                    id: product.id,
                    action: "buy"
                })
                console.log('UPDATE STOCK PRODUCT');
            })
            .catch(function (error) {
                console.log(error);
            });

            //create transaction and set param
            var param = {
                name: 'Compra producto',
                type: 'compra',
                quantity: 1,
                product_id: product.id
            }
            axios.post('http://localhost:8000/v1/transaction/create', param)
            .then(function () {
                state.commit('ADDTRANSACTION', {
                    transaction: param
                })
                console.log('CREATE TRANSACTION');
            })
            .catch(function (error) {
                console.log(error);
            });
            //we can't see the transaction_id
            state.dispatch('getTransactions');
        },
        sellProduct(state, product){
            //update stock product -1
            var updateParam = {
                name: product.name, 
                description: product.description,
                price: product.price, 
                stock: product.stock+1
            }
            axios.put('http://localhost:8000/v1/stock/'+product.id, updateParam)
            .then(function () {
                state.commit('UPDATEPRODUCTSTOCK', {
                    id: product.id,
                    action: "sell"
                })
                console.log('UPDATE STOCK PRODUCT');
            })
            .catch(function (error) {
                console.log(error);
            });

            //create transaction and set param
            var param = {
                name: 'Venta producto',
                type: 'venta',
                quantity: 1,
                product_id: product.id
            }
            axios.post('http://localhost:8000/v1/transaction/create', param)
            .then(function () {
                state.commit('ADDTRANSACTION', {
                    transaction: param
                })
                console.log('CREATE TRANSACTION');
            })
            .catch(function (error) {
                console.log(error);
            });
            //we can't see the transaction_id
            state.dispatch('getTransactions');
        },
        getTransactions(state) {
            axios.get('http://localhost:8000/v1/transaction/list')
            .then(function (response) {
                state.commit('ALLTRANSACTIONS', {
                    transactions: response.data
                })
                console.log('LIST ALL TRANSACTIONS');
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        deleteTransaction(state, transaction){
            var action = (transaction.type == 'compra') ? 'sell' : 'buy';
            state.commit('UPDATEPRODUCTSTOCK', {
                id: transaction.product_id,
                action: action
            });
            axios.delete('http://localhost:8000/v1/transaction/'+transaction.id)
            .then(function () {
                state.commit('DELETETRANSACTION', transaction.id);
                console.log('DELETE TRANSACTION');
            })
            .catch(function (error) {
            console.log(error);
            });
        }
    }
})

export default store;