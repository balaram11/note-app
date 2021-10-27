<template>
    <div>
        
        <!-- Note Modal Form -->
        <div class="mb-2">
            <b-button id="show-modal-btn" variant="outline-primary" @click="showModal">Add Note</b-button>
        </div>

        <b-modal ref="note-modal" hide-footer title="Add Note">
            <div class="row">
                <div class="col-md-12">
                    <form>
                        <!-- Title -->
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label">Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" v-model="form.title" id="title">
                                <span v-if="errors.title" class="text-danger">{{ errors.title[0] }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="description" v-model="form.description" rows="5"></textarea>
                                <span v-if="errors.description" class="text-danger">{{ errors.description[0] }}</span>
                            </div>
                        </div>

                        <!-- TAGS -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tags</label>
                            <div class="col-sm-8">
                                <div class="form-check" v-for="tag in tags" :key="tag.id">
                                    <input class="form-check-input" type="checkbox" :value="tag.id"
                                        v-model="form.checkedTags" :id="tag.id">
                                    <label class="form-check-label">
                                        {{tag.tag_name}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <b-button size="sm" variant="outline-secondary" 
                @click="hideModal">Cancel</b-button>
            <b-button size="sm" variant="outline-secondary" type="button" 
                @click="addNotes">ADD</b-button>
        </b-modal>

        <!-- Notes Listing -->
        <div class="row">
            <div class="col-md-12" v-for="note in notes.data" :key="note.id">
                <div class="card border-top-0 border-left-0 border-right-0 rounded-0 mb-3">
                    <div class="card-header bg-white border-0 p-1"><b>{{note.title}}</b> <span class="float-right">Created At: {{note.created_at}}</span></div>
                    <div class="card-body p-1">
                        {{note.description}}
                        <div>
                            <span class="badge badge-primary mr-1" v-for="tag in note.tags" :key="tag.id">{{tag.tag_name}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Notes",
    data() {
        return {
            notes : [],
            form:{
                title:null,
                description:null,
                checkedTags:[]
            },
            errors:[],
            tags: []
        }
    },
    created() {
        this.getNotes();
        this.getTags();
    },
    methods:{
        showModal() {
            this.$refs['note-modal'].show()
        },
        hideModal() {
            this.$refs['note-modal'].hide()
        },
        getNotes(){
            axios.get(BASE_URL + '/api/notes')
                .then(response => {
                    this.notes = response.data;
                }).catch(error=>{
                    console.log("error ",error.response)
                });
        },
        getTags(){
            axios.get(BASE_URL + '/api/tags')
                .then(response => {
                    this.tags = response.data;
                }).catch(error=>{
                    console.log("error ",error.response)
                });
        },
        addNotes(){
            axios.post(BASE_URL + '/api/add/notes',this.form).then(response=>{
                console.log(response.data)
                this.form.title=null
                this.form.description =null
                this.form.checkedTags = []
                this.errors = []
                this.hideModal()
                this.getNotes()
            }).catch(error=>{
               
                if(error.response.status === 422){
                    this.errors = error.response.data.errors;
                }
                console.log(error);
            });
        }
    }
}
</script>

<style scoped>

</style>