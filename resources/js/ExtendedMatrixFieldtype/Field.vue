<template>
    <div>
        <ui-field-group
            :label="field.name"
            :fieldId="`${field.handle}-field`"
            :name="field.handle"
            :inline="false"
            :help="field.help"
            :required="field.required"
            :has-error="hasError(field.handle)"
            :error-message="errorMessage(field.handle)"
            >
            
            <treeselect :async="true" :load-options="asyncFind" v-model="model" :multiple="field.settings.multiple" />

            <!-- <p v-if="showAddNew" class="text-sm leading-none">Add a {{ singular }} below.</p> -->

            <div class="border-t pt-6" v-if="form && field.settings.showAddNew">
                <ui-input-group
                    class="mb-2"
                    :name="entry + '_name'"
                    :placeholder="'New ' + singular + ' name...'"
                    @keyup.enter.native="submit"
                    required
                    :has-error="form.errors.has('name')"
                    :error-message="form.errors.get('name')"
                    v-model="form.name">
                </ui-input-group>
                <ui-button @click.prevent="submit">Add {{ singular }}</ui-button>
            </div>
        
        </ui-field-group>
    </div>
</template>

<script>
    import queryString from 'query-string'
    import pluralize from 'pluralize'
    import Form from '@/services/Form'
    import FieldMixin from '@/mixins/fieldtypes/field'
    // import the component
    import Treeselect from '@riophae/vue-treeselect'
    // import the styles
    import '@riophae/vue-treeselect/dist/vue-treeselect.css'

    export default {
        name: 'extended-matrix-fieldtype',

        mixins: [FieldMixin],
        
        components: { Treeselect },

        data() {
            return {
                matrix: {},
                form: false,
                loading: false,
                entries: null,
            }
        },

        computed: {
            endpoint() {
                return `/api/matrix/${this.field.settings.matrix}/collections`
            },
            
            entry() {
                if (this.matrix.name) {
                    return this.matrix.name.toLowerCase()
                } else {
                    return 'entries'
                }
            },

            singular() {
                return pluralize.singular(this.entry)
            }
        },

        methods: {
            // treeSelectOptions(entries) {
            //     if (!entries) return [];
                
            //     return entries.filter((entry) => {
            //             return ! entry.parent_entry || entry.parent_entry.length == 0
            //         }).map((entry) => {
            //             if (entry.children_entry && entry.children_entry.length > 0) {
            //                 return {
            //                     id: entry.id,
            //                     label: entry.name,
            //                     children: entry.children_entry.map((entry) => {
            //                         return {
            //                             id: entry.id,
            //                             label: entry.name,
            //                         }
            //                     }).sort((a, b) => a.label.localeCompare(b.label))
            //                 }
            //             } else {
            //                 return {
            //                     id: entry.id,
            //                     label: entry.name,
            //                 }
            //             }
            //         }).sort((a, b) => a.label.localeCompare(b.label))
            // },

            getQueryParameters(params) {
                
                if (params.search !== '') {
                    params['filter[search]'] = params.search
                }
                return queryString.stringify(params)
            },

            itemMap(item) {
                return {
                    id: item.entry.id,
                    label: item.entry.name,
                }
            },

            asyncFind({ action, searchQuery, callback }) {
                if (action === 'ASYNC_SEARCH') {
                    this.getRecords({ search: searchQuery }).then((response) => {
                        callback(null, response.data.data.map(this.itemMap))
                    })
                }
            },

            submit() {
                this.form.post(`/api/collections/${this.matrix.slug}`).then((response) => {
                    toast('Entry saved successfully', 'success')

                    this.fetchMatrix()
                    this.resetForm()
                }).catch((response) => {
                    toast(response.message, 'failed')
                })
            },

            resetForm() {
                this.form = new Form({
                    name: '',
                    slug: '',
                    status: 1,
                })
            },
            
            getRecords(params) {
                this.loading = true

                return axios.get(`${this.endpoint}?${this.getQueryParameters(params)}`).then((response) => {
                    this.loading = false

                    return response;
                })
            },

            fetchMatrix() {
                axios.get(`/api/matrices/${this.field.settings.matrix}?entries=1`).then((response) => {
                    this.matrix = response.data.data
                })
            }
        },

        mounted() {
            this.fetchMatrix()
            this.resetForm()

            this.model = _.map(this.value, 'id') || []
        }
    }
</script>