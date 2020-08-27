<template>
    <div>
        <div class="field">
            <div class="control store-select is-size-5">
                <label for="city" class="is-bold mr-2 mb-0">{{ translate.labelAt }}</label>
                <div class="select">
                    <select name="city" id="city" v-model="mCity" @change="getRestaurent()" class="form-control @error('city') is-invalid @enderror">
                        <option value>{{ theTranslate.option }}</option>
                        <option v-for="city in theCities" :key="city.id" :value="city.id">{{ city.name }}</option>
                    </select>
                </div>
            </div>
        </div>
      
        <carousel 
            :scrollPerPage="true" 
            :perPageCustom="[[350, 1], [550, 2], [1140, 3]]"
            :navigationEnabled="true"
            :navigationNextLabel="prev"
            :navigationPrevLabel="next"      
            >
            <slide v-for="restaurent in theRestaurents" :key="restaurent.id">
                 <div class="card" aria-id="contentIdForA11y3">
                    <div class="card-image">
                        <div class="image is-4by3">
                            <template v-if="!loading"><img :src="restaurent.image"></template>
                            <b-skeleton size="is-large" width="100%" height="100%" :active="loading"></b-skeleton>
                        </div>
                    </div>
                    <div class="card-content">
                        <p class="title is-size-6 is-uppercase mb-2">
                            <template v-if="!loading">{{ restaurent.name }}</template>
                            <b-skeleton size="is-large" :active="loading"></b-skeleton>
                        </p>
                        
                        <p class="content">
                            <template v-if="!loading"><span class="icon"><i class="fas fa-building"></i></span>{{ restaurent.city }}</template>
                            
                        </p>
                        <p class="content address">
                            <template v-if="!loading"><span class="icon"><i class="fas fa-map-marker-alt"></i></span>{{ restaurent.address }}</template>
                            <b-skeleton size="is-large" :active="loading"></b-skeleton>
                        </p>
                        <p class="content">
                            <template v-if="!loading"> <a :href="restaurent.website" class=" button is-outlined is-small is-rounded is-info mt-5"><span>{{ theTranslate.view }}</span><span class="icon"><i class="fas fa-chevron-right"></i></span></a></template>
                            <b-skeleton size="is-large" :active="loading"></b-skeleton>
                        </p>
                       
                                       
                    </div>
                   
                </div>
            </slide>
           
            </carousel>
    </div>
    
</template>



<script>
import { Carousel, Slide } from 'vue-carousel';
export default {
      components: {
            Carousel,
            Slide
        },
    props: {
        lang: {
            type: String,
            required: true,
        },
        translate: {
            type: Object,
            required: true
        }
    },
    data () {
        return {
            theCities: [],
            theRestaurents: [],
            theLang: this.lang,
            mCity: "",
            loading: false,
            theTranslate: this.translate,
            prev: '<span class="icon"><i class="fas fa-chevron-right"></i></span>',
            next: '<span class="icon"><i class="fas fa-chevron-left"></i></span>'
        }
        
    },
    watch: {
        loading: _.debounce(function(){
            this.loading = false;
        }, 1500)
    },
    methods: {
        getRestaurent: function(){
            const vm = this;
            
            axios.get('http://localhost/mystery/api/restaurentList', {
                params: {
                    lang: this.theLang,
                    city: this.mCity,
                }
            }).then(function(response){   
                
                vm.theRestaurents = response.data;
                vm.loading = true;
             
            }).catch(function(error){
                console.log(error)
            });
        },
        getCategory: function(){
            const vm = this;
            axios.get('http://localhost/mystery/api/cityList', {
                params: {
                    lang: this.theLang,
                }
            }).then(function(response){
                vm.theCities = response.data;
            }).catch(function(error){
                console.log(error)
            });
        },
    },
    mounted () {   
        this.getCategory();
        this.getRestaurent();
    },
}
</script>

<style lang="scss">
.is-bold{
    font-weight: bold;
}
    .media{
        flex-wrap: wrap;
    }
    .media-content{
        flex: 1;
        width: 100%;
        flex-basis: 100%;
    }
    .media-left{
        margin: 0;
        flex: 1;
        width: 100%;
    }
    div.image .b-skeleton{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%
    }
    .VueCarousel{
        .VueCarousel-navigation{
            span.icon{
                background: white;
                box-shadow: 0px 0px 20px -5px rgb(0 0 0 / 30%);
                border-radius: 50%;
                width: 2.5rem;
                height: 2.5rem;
            }
        }
        .VueCarousel-navigation-prev{
            left: 40px
        }
        .VueCarousel-navigation-next{
            right: 40px
        }
       
    }
    .VueCarousel-slide{
        padding: 20px;
        .card{
            height: 100%
        }
      
    }
    p.content{
        margin-bottom: 0 !important;
        font-size: .9rem;
        &.address{
            min-height: 50px
        }
    }
    .card-content{
        padding: 1rem;
        p.title{
            line-height: 1.5;
            
        }
    }
    .store-select{
        display: flex;
        align-items: center;
        justify-content: center;
        vertical-align: middle;
        select.form-control{
            border: none;
            padding-left: 0;
            color: #03d1b2;
            font-weight: bold;
            background-color: transparent;
        }
        .select:not(.is-multiple):not(.is-loading)::after{
            border-color: #03d1b2;
        }
        .select select:focus{
            box-shadow: none;
        }
    }
</style>