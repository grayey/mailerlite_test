

<template>

<div>
    <div class="container" v-if="loading">loading...</div>

    <div class="container" v-if="!loading">
        <b-card :header="'Welcome, ' + account.name || 'Guest' " class="mt-3">
            <b-card-text>
                <div>
                    Account: <code>{{ account.id }}</code>
                </div>
                <div>
                    Balance:
                    <code>{{ account.currency === "usd" ? "$" : "€"
              }}{{ account.balance }}</code
            >
          </div>
        </b-card-text>
        <b-button size="sm" variant="success" @click="show = !show"
          >New payment</b-button
        >

        <b-button
          class="float-right"
          variant="danger"
          size="sm"
          nuxt-link
          to="/"
          >Logout</b-button
        >
      </b-card>

      <b-card class="mt-3" header="New Payment" v-show="show">
        <b-form @submit="onSubmit">
          <b-form-group id="input-group-1" label="To:" label-for="input-1">
            <b-form-input
              id="input-1"
              size="sm"
              v-model="payment.to"
              type="number"
              required
              placeholder="Destination ID"
            ></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-2" label="Amount:" label-for="input-2">
            <b-input-group prepend="$" size="sm">
              <b-form-input
                id="input-2"
                v-model="payment.amount"
                type="number"
                required
                placeholder="Amount"
              ></b-form-input>
            </b-input-group>
          </b-form-group>

          <b-form-group id="input-group-3" label="Details:" label-for="input-3">
            <b-form-input
              id="input-3"
              size="sm"
              v-model="payment.details"
              required
              placeholder="Payment details"
            ></b-form-input>
          </b-form-group>

          <b-button type="submit" size="sm" variant="primary">Submit</b-button>
        </b-form>
      </b-card>

      <b-card class="mt-3" header="Payment History">
        <b-table striped hover :items="transactions"></b-table>
      </b-card>
    </div>
  </div>

</template>

<script lang="ts">

import Vue from "vue";
import axios from "axios"
import * as AppService from "../../../services/appMain.service";
import * as StorageService  from "../../../services/storage.service";

declare const $:any;



export default Vue.extend({

    layout: 'dashboard',
    data() {
            return {
                show: false,
                payment: {},

                account: {},
                transactions: [],

                loading: false
            };
        },

        async mounted() {


          this.account = StorageService.getActiveAccount();
          this.getAllAccountTransactions();
            // axios.get(`http://localhost:8000/api/accounts/${this.$route.params.id}`).then((response) => {
            //         if (!response.data.length) {
            //             window.location.href = "/";
            //         } else {
            //             this.account = response.data[0];

            //             if (this.account && this.transactions) {
            //                 this.loading = false;
            //             }
            //         }
            //     });

            // axios.get(`http://localhost:8000/api/accounts/${this.$route.params.id}/transactions`).then(
            //   (response)=> {
            //         // this["transactions"] = response.data;

            //         var transactions:any = [];
            //         for (let i = 0; i < this.transactions.length; i++) {
            //             this.transactions[i]['amount'] =
            //                 (this.account.currency === "usd" ? "$" : "€") +
            //                 this.transactions[i].amount;

            //             if (this.account.id != this.transactions[i].to) {
            //                 this.transactions[i].amount = "-" + this.transactions[i].amount;
            //             }

            //             transactions.push(this.transactions[i]);
            //         }

            //         this.transactions = transactions;

            //         if (this.account && this.transactions) {
            //             this.loading = false;
            //         }
            //     });
        },

        methods: {


          async getAllAccountTransactions(){
              await AppService.getTransactionsByAccountId(this.$route.params.id).then(
                (transactionsResponse:any)=>{

                }).catch(
                (error:any)=>{

              })

          },


            // onSubmit(evt:any) {
            //     evt.preventDefault();

            //     axios.post(`http://localhost:8000/api/accounts/${this.$route.params.id}/transactions`,this.payment);

            //     this.payment = {};
            //     this.show = false;

            //     // update items
            //     setTimeout(() => {
            //         axios
            //             .get(`http://localhost:8000/api/accounts/${this.$route.params.id}`)
            //             .then((response) => {
            //                 if (!response.data.length) {
            //                     window.location.href = "/";
            //                 } else {
            //                     this.account = response.data[0];
            //                 }
            //             });

            //         axios
            //             .get(
            //                 `http://localhost:8000/api/accounts/${
            //   this.$route.params.id
            // }/transactions`
            //             )
            //             .then((response) => {
            //                 this.transactions = response.data;

            //                 var transactions = [];
            //                 for (let i = 0; i < this.transactions.length; i++) {
            //                     this.transactions[i].amount =
            //                         (this.account.currency === "usd" ? "$" : "€") +
            //                         this.transactions[i].amount;

            //                     if (this.account.id != this.transactions[i].to) {
            //                         this.transactions[i].amount = "-" + this.transactions[i].amount;
            //                     }

            //                     transactions.push(this.transactions[i]);
            //                 }

            //                 this.transactions = transactions;
            //             });
            //     }, 200);
            // }


       }
});

</script>
