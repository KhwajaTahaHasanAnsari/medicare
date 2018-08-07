<template> 
<App-Productlist>
   <!--<p>  product : {{products}} </p>-->
  <!-- <slot>
   <li v-for="product in products" :key ="product.id">
       {{Product}}
    </li>
    </slot>
    -->
   </App-Productlist>



</template>

<script>
        export default {
             props: [
                         'products'
                 ],
                data(){
                return{

                 }
                },
                mounted()
                {
                    
                },
                methods: {

                    
                }
            }

</script>

<style>




</style>