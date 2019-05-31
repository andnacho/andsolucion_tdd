<template>
    <modal name="new-project" classes="p-10 bg-card rounded-lg text-default" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's Start Something New</h1>
        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>
                        <input
                                type="text"
                                id="title"
                                class="border p-2 text-xs block w-full rounded"
                                :class="form.errors.title ? 'border-error' : 'border-muted-light'"
                                v-model="form.title">
                        <span class="text-xs italic text-error" v-if="form.errors.title" v-text="form.errors.title[0]"></span>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="text-sm block mb-2">Description</label>
                        <textarea type="text" id="description"
                                  class="border p-2 text-xs block w-full rounded" rows="7"
                                  :class="form.errors.title ? 'border-error' : 'border-muted-light'"
                                  v-model="form.description"></textarea>
                        <span class="text-xs italic text-error" v-if="form.errors.description" v-text="form.errors.description[0]"></span>

                    </div>
                </div>

                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label class="text-sm block mb-2">Need Some Tasks?</label>
                        <input
                                type="text"
                                id="task"
                                class="border border-muted-light p-2 mb-2 text-xs block w-full rounded"
                                placeholder="Task 1"
                                v-for="task in form.tasks"
                                v-model="task.body">
                    </div>

                    <button type="button" class="inline-flex items-center text-xs icon-theme" @click="addTask">
                        <svg height="18" class="mr-2" viewBox="0 0 512 512" width="18"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="m437.019531 74.980469c-48.351562-48.351563-112.640625-74.980469-181.019531-74.980469s-132.667969 26.628906-181.019531 74.980469c-48.351563 48.351562-74.980469 112.640625-74.980469 181.019531s26.628906 132.667969 74.980469 181.019531c48.351562 48.351563 112.640625 74.980469 181.019531 74.980469s132.667969-26.628906 181.019531-74.980469c48.351563-48.351562 74.980469-112.640625 74.980469-181.019531s-26.628906-132.667969-74.980469-181.019531zm-181.019531 397.019531c-119.101562 0-216-96.898438-216-216s96.898438-216 216-216 216 96.898438 216 216-96.898438 216-216 216zm20-236.019531h90v40h-90v90h-40v-90h-90v-40h90v-90h40zm0 0"/>
                        </svg>
                        <span class="text-default">Add New Task Field</span>
                    </button>


                </div>
            </div>
        </form>
        <footer class="flex justify-end">
            <button type="button" class="button is-outlined mr-4" @click="$modal.hide('new-project')">Cancel</button>
            <button class="button ml-3" @click="submit">Create Project</button>
        </footer>
    </modal>
</template>
<script>
    import BirdboardForm from './BirdboardForm';

    export default {
        data() {
            return {
                form: new BirdboardForm({
                    title: '',
                    description: '',
                    tasks: [
                        {body: ''},
                    ]
                })


            };
        },

        methods: {
            addTask() {
                this.form.tasks.push({body: ''});
            },

            // submit() {
            //     axios.post('/projects', this.form)
            //         .then(response => {
            //             location = response.data.message;
            //             // location.reload();
            //         })
            //         .catch(error => {
            //             this.errors = error.response.data.errors;
            //         });
            // }

            async submit(){

                if(! this.form.tasks[0].body){
                    delete this.form.originalData.tasks;
                }
                this.form.submit('/projects')
                    .then(response => location = response.data.message)
                    .catch();

                // try{
                //     let response = await axios.post('/projects', this.form);
                //     location = response.data.message;
                // }catch(error){
                //     this.errors = error.response.data.errors;
                // }
            }

        },
    }
</script>

<style scoped>

</style>