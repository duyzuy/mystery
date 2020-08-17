<template>

       <li class="mb-2"> 
                                          <div class="content">
                                            <p> {{ answer.answer.en }}  -  <span class="badge badge-danger"> {{ point }} point </span></p>
                                            <span @click="removeAnswer(index)">remove</span>
                                          </div>
                                    
                                          <input type="hidden" name="answers[{index}][answer][en]" :value="answer.answer.en" />
                                          <input type="hidden" name="answers[][answer][vi]" :value="answer.answer.vi" />
                                          <input type="hidden" name="answers[][point]" :value="point" />
                                         
                                        </li> 

</template>

<script>
    export default {
       props: {
            answer: {
                type: Object,
                required: true,
            },
            index: { 
                type: Number,
                required: true
            }
       }, 
       data (){
           return{
                id: this.answer.id,
                answer: this.answer,
                point: this.answer.point,
           }
       }
    }
</script>
