<template>
    <div>
          <!-- @if(auth()->check()) -->
            <!-- <form method="POST" action="{{$thread->path() . '/replies'}}"> -->
                       <!--  csrf_token not need, have in bootstrap.js -->
                  <div v-if="signedIn">
                        <div class="form-group">
                            <textarea name="body" 
                                      id="body"
                                      class="form-control" 
                                      placeholder="Have something to say?????"
                                      rows="5"
                                      required
                                      v-model="body"></textarea>
                        </div>
                      
                        <button type ="submit"
                                class="btn btn-outline-primary"
                                @click="addReply">Post</button>
                  </div>
            <!-- </form> -->
        <!-- @else --> 
                                 <p class="text-center" v-else>
                
                                         Please <a href="/login">sign in</a>
                                         to participate in this discussion.
                                 </p>
       <!--  @endif -->
    </div> 
   
</template>

<script>

export default {


    data() {
        
        return {
            body:'',
            
        };
    },

    computed: {
        signedIn() {
            return window.App.signedIn;
        }
    },

    methods: {
            addReply() {
                axios.post(location.pathname + '/replies', { body:this.body})
                   
                    .then(({data}) => {
                        this.body = '';


                        flash('Your reply has been posted.');

                        this.$emit('created', data );
                    });
            }
        }
    }




</script>
