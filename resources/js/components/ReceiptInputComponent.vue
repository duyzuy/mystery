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
            
            <ul>
                <li :class="{ valid: valids.region }" >The first string should be in <strong>N</strong>, <strong>S</strong>, <strong>C</strong><span v-show="valids.region" class="icon"><i class="far fa-check-circle"></i></span></li>
                <li :class="{ valid: valids.brand }">The second string should be in <strong>A</strong>, <strong>J</strong>, <strong>P</strong><span v-show="valids.brand" class="icon"><i class="far fa-check-circle"></i></span></li>
                <li :class="{ valid: valids.store }">The Third string should be in <strong>HBT</strong>, <strong>PXL</strong>, <strong>VHM</strong><span v-show="valids.store" class="icon"><i class="far fa-check-circle"></i></span></li>
            </ul>
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
            }
        },
        data () {
            return{
                receipt: this.oldreceipt,
                receiptValid: '',
                valids: [],
                errors: [],
                help: false, 
                region: '',
                brand: '',
                store: '',
            }
        },
        methods: {
            onFocus: function(event){
                this.help = true;
                event.target.focus();
            },
            isRegion: function(value){
                const regionValid = ['N', 'S', 'C']
                if(regionValid.includes(value)){
                    return true;
                }
             return false;
            },
            isBrand: function(value){
                const brandValid = ['A', 'J', 'P'];
                if(brandValid.includes(value)){
                    return true
                }
                return false;
            },
            isStore: function(value){
                const storeValid = ['HBT', 'PXL', 'VHM']
                if(storeValid.includes(value)){
                    return true
                }
                return false;
            },
            replaceCharacters: function(value){
                const regExpr = /[^a-zA-Z0-9]/g;
                return value.replace(regExpr, '');
            },
            replaceSpace: function(value){
                  return value.replace(/ /g, '');
            },
            setReceipt: function(value){
                const vm = this;
                if(value.length > 0 ){
                    value = value.toUpperCase();

                    const region = value.substr(0, 1);
                    const brand = value.substr(1,1);
                    const store = value.substr(2,3);
                    const remain = value.substr(5);
                    
                    this.receiptValid = region + '.' + brand + '.' + store + remain;
                    vm.$emit('receipt-value', vm.receiptValid);
                }else{
                     this.receiptValid = '';
                }
              
               
            }
        },
        watch: {
            receipt: function(){
              
                this.receipt = this.receipt.toUpperCase();
                this.receipt = this.replaceCharacters(this.receipt);
                this.receipt = this.replaceSpace(this.receipt);

                if(this.receipt.length == 1){

                    const region = this.receipt.substr(0, 1);
                    
                
                    if(this.isRegion(region)){

                        this.valids['region'] = true;
                        this.region = region;

                    } else {
                           
                        this.valids['region'] = false;
                        this.region = '';
                           
                    } 
                }else if(this.receipt.length == 0){

                    this.valids['region'] = false;
                    this.region = '';
           
                }

                if(this.receipt.length == 2){

                        const brand = this.receipt.substr(1,1);
                        
                       
                        if(this.isBrand(brand)){
                            
                            this.valids['brand'] = true;
                            this.brand = brand;

                        } else {

                            this.valids['brand'] = false;
                            this.brand = '';
                        }
                       
                }else if(this.receipt.length < 2){
                      
                        this.valids['brand'] = false;
                        this.brand = '';
                  
                }
                    
                if(2 < this.receipt.length && this.receipt.length <= 5){

                    const store = this.receipt.substr(2,3);
                 

                    if(this.isStore(store)){
                            
                        this.valids['store'] = true;
                        this.store = store;

                    } else {

                        this.valids['store'] = false;
                            this.store = '';
                    }
                        
                }else if(this.receipt.length < 5){

                    this.valids['store'] = false;
                       this.store = '';

                }
                
                this.$emit('receipt-value', this.receipt);
                

            }
        },
    }
</script>
<style lang="scss">
.jserror{
    li{
        position: relative;
        padding-right: 30px;
        min-height: 20px;
        &.valid{
            color: #38c172;
                strong{
                color: #38c172
            }
        }
        
        
        span.icon{
            position: absolute;
            right: 0;
            width: 18px;
            height: 18px;
        }
    }
    
}
</style>