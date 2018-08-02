<template> 
<div id =#app>
   <!--<p>  product : {{products}} </p>-->
  <!-- <slot>
   <li v-for="product in products" :key ="product.id">
       {{Product}}
    </li>
    </slot>
    -->
   </div>



</template>

<script>
        export default {
             props: [
                         'products'
                 ],
                data(){
                return{ }
                },
                mounted()
                {
                        alert (ready);
                },
                methods: {

                    
                }
            }

</script>

<style>




</style>