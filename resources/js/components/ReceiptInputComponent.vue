<template>
   <div>
       <input 
            type="text" 
            v-model="receipt" 
            class="input"
            @focus="onFocus($event)"
            @blur="help = false"
            :class="invalid" 
            :placeholder="placeholder">

        <p style="position: absolute">{{ receiptValid }}</p>

        <div class="jserror" v-if="help">
            
            <div class="wrap_list_code">
                <p :class="{valid: valid}"><strong>The receipt must include one of code bellow</strong> <span v-show="valid" class="icon"><i class="far fa-check-circle"></i></span></p>
                <span v-for="(code, index) in restaurantCodeList" :key="index" class="code">{{code.code}}</span>
            </div>
        </div>
   </div>
</template>

<script>
    export default {
        props: {
            placeholder: {
                type: String, 
                required: true,
            },
            invalid:{
                type: String,
                required: true,
            },
            oldreceipt:{
                type: String,
            },
            restaurantcode: {
                type: String,
                required: true
            }
        },
        data () {
            return{
                receipt: this.oldreceipt,
                receiptValid: '', 
                help: false, 
                loading: false,
                restaurantCodeList: [],
                valid: false,
                restaurantRegister: this.restaurantcode
            }
        },
        methods: {
            onFocus: function(event){
                this.help = true;
                event.target.focus();
            },
            getRestaurantCode: function(){
                const vm = this;
            
                axios.get('https://guestsurvey.afg.vn/api/restaurantCode').then(function(response){   
                
                    vm.loading = true;
                    vm.restaurantCodeList = response.data;

                }).catch(function(error){
                    console.log(error)
                });
            }
        },
        mounted () {   
            this.getRestaurantCode();
        },
        watch: {
            receipt: function(){
                
                
                const vm = this;
                const codeRegister = this.restaurantRegister;
                if(this.receipt.length == 0){
                    return;
                }
               

                this.receipt = this.receipt.toUpperCase().trim();
                const lng = codeRegister.length;
            
                if(this.receipt.length < lng){

                    vm.valid = false;
        
                }
                if(this.receipt.length >= lng){
                     
                    const codeCheck = this.receipt.substring(0, lng);
 
                    if(codeCheck == codeRegister){
                        vm.valid = true;
                    }


                }
                
                this.$emit('receipt-value', this.receipt);

            }
        }
    }
</script>
<style lang="scss">
.jserror{
    .wrap_list_code{
        p{
            position: relative;
            padding-right: 30px;
            min-height: 20px;
            margin-bottom: 10px;

            &.valid{
                color: #38c172;
                span.icon, strong{
                    color: #38c172;
                }
            }
        }
    }
        
        
        span.icon{
            position: absolute;
            right: 0;
            width: 18px;
            height: 18px;
        }
        .code{
            display: inline-block;
            background: #ececec;
            margin-right: 10px;
            margin-bottom: 10px;
            padding: 0 5px;
            border-radius: 5px;
        }

    
}
</style>