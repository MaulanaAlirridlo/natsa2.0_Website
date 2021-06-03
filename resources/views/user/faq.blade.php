@extends('layouts.web')

@section('title','FAQ')

@section('header')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet"> 
<style>
   /* Tab content - closed */
   .tab-content {
   max-height: 0;
   -webkit-transition: max-height .35s;
   -o-transition: max-height .35s;
   transition: max-height .35s;
   }
   /* :checked - resize to full height */
   .tab input:checked ~ .tab-content {
   max-height: 100vh;
   }
   /* Label formatting when open */
   .tab input:checked + label{
   /*@apply text-xl p-5 border-l-2 border-red-700 bg-gray-200 text-indigo*/
   font-size: 1.25rem; /*.text-xl*/
   padding: 1.25rem; /*.p-5*/
   border-left-width: 8px; /*.border-l-2*/
   border-color: #811313; /*.border-indigo*/
   background-color: #0e2c4b; /*.bg-gray-100 */
   color: #eeecec; /*.text-indigo*/
   }
   /* Icon */
   .tab label::after {
   float:right;
   right: 0;
   top: 0;
   display: block;
   width: 1.5em;
   height: 1.5em;
   line-height: 1.5;
   font-size: 2rem;
   text-align: center;
   -webkit-transition: all .35s;
   -o-transition: all .35s;
   transition: all .35s;
   }
   /* Icon formatting - closed */
   .tab input[type=checkbox] + label::after {
   content: "+";
   font-weight:bold; /*.font-bold*/
   border-width: 1px; /*.border*/
   border-radius: 9999px; /*.rounded-full */
   border-color: #b8c2cc; /*.border-grey*/
   }
   .tab input[type=radio] + label::after {
   content: "\25BE";
   font-weight:bold; /*.font-bold*/
   border-width: 1px; /*.border*/
   border-radius: 9999px; /*.rounded-full */
   border-color: #b8c2cc; /*.border-grey*/
   }
   /* Icon formatting - open */
   .tab input[type=checkbox]:checked + label::after {
   transform: rotate(315deg);
   background-color: #ffffff; /*.bg-indigo*/
   color: #050505; /*.text-grey-lightest*/
   }
   .tab input[type=radio]:checked + label::after {
   transform: rotateX(180deg);
   background-color: #fcfcfc; /*.bg-indigo*/
   color: #000000; /*.text-grey-lightest*/
   }
</style>

@endsection


@section('body')





   <h1 class="text-center text-4xl font-extrabold font-serif">Frequently Asked Question </h1>
   <h2 class="text-center text-2xl font-hairline font-serif">Get the latest news & updates from Elyssi</h2>
     
      <div class="w-full md:w-3/5 mx-auto p-8">
         <div class="shadow-lg rounded-b-lg rounded-t-lg rounded-r-lg rounded-l-lg">
            <div class="tab w-full overflow-hidden border-t border-b border-l border-r border-gray-300 rounded-r-lg rounded-l-lg">
               <input class="absolute opacity-0" id="tab-single-one" type="radio" name="tabs2">
               <label class="block p-5 leading-normal cursor-pointer font-hairline font-serif" for="tab-single-one">Label One</label>
               <div class="tab-content overflow-hidden border-l-2 bg-gray-200 border-blue-700 leading-normal">
                  <p class="p-5 font-hairline font-serif">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, architecto, explicabo perferendis nostrum, maxime impedit atque odit sunt pariatur illo obcaecati soluta molestias iure facere dolorum adipisci eum? Saepe, itaque.</p>
               </div>
            </div>
           
         </div>
      </div>
  

@endsection


@section('script')

<script>
    /* Optional Javascript to close the radio button version by clicking it again */
    var myRadios = document.getElementsByName('tabs2');
    var setCheck;
    var x = 0;
    for(x = 0; x < myRadios.length; x++){
        myRadios[x].onclick = function(){
            if(setCheck != this){
                 setCheck = this;
            }else{
                this.checked = false;
                setCheck = null;
        }
        };
    }
 </script>

@endsection

