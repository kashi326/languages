<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- use the latest vue-select release -->
<script src="https://unpkg.com/vue-select@latest"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

{{-- vue calendar --}}
<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/moment.min.js"></script>
<script src="https://unpkg.com/vue-business-hours"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<script src="{{asset('js/languages.js')}}"></script>
<script src="{{asset('js/levels.js')}}"></script>
<script src="{{asset('js/ajax-obstructive.js')}}"></script>

<script>
    Vue.component('v-select', VueSelect.VueSelect);
    new Vue({
        el: "#main-container",
        data: function () {
            return {
                loading: false,
                languages: languages,
                levels: levels,
                primaryLangs: {!! $langs !!},
                other_langs: [],
                avatarUrl: '',
                errors: {},
                form: {
                    phone: "",
                    intro_link: "",
                    primary_lang: {},
                    about: "",
                    agree: false,
                },
                days: {
                    sunday: [
                        {
                            open: '',
                            close: '',
                            id: '5ca5578b0c5c7',
                            isOpen: false
                        }
                    ],
                    monday: [
                        {
                            open: '',
                            close: '',
                            id: '5ca5578b0c5d1',
                            isOpen: false
                        }
                    ],
                    tuesday: [
                        {
                            open: '',
                            close: '',
                            id: '5ca5578b0c5d8',
                            isOpen: false
                        }
                    ],
                    wednesday: [
                        {
                            open: '',
                            close: '',
                            id: '5ca5578b0c5df',
                            isOpen: false
                        }
                    ],
                    thursday: [
                        {
                            open: '',
                            close: '',
                            id: '5ca5578b0c5e6',
                            isOpen: false
                        }
                    ],
                    friday: [
                        {
                            open: '',
                            close: '',
                            id: '5ca5578b0c5ec',
                            isOpen: false
                        },
                    ],
                    saturday: [
                        {
                            open: '',
                            close: '',
                            id: '5ca5578b0c5f8',
                            isOpen: false
                        }
                    ]
                }
            };
        },
        methods: {
            convert(input) {
                return moment(input, 'HH:mm:ss').format('h:mm:ss A');
            },
            addLang() {
                this.other_langs.push({
                    id: this.other_langs.length + 1, language: {
                        name: "",
                        code: ""
                    }, level: {
                        name: ""
                    }
                });
            },
            removeLang(id) {
                this.other_langs = this.other_langs.filter((item) => {
                    return item.id != id;
                })
            },
            handleAvatar(ev) {
                const url = ev.target.files[0];
                this.avatarUrl = URL.createObjectURL(url);
                this.form.avatar = url;
            },
            handleSubmit() {

                const data = {
                    details: this.form,
                    days: this.days,
                    other_langs: this.other_langs
                }

                this.loading = true;
                axios.post("/teacher/register", data).then((val) => {
                    this.loading = false;
                    if (val.status == 200) {
                        location.href = '/'
                    }
                }).catch((error) => {
                    this.loading = false;
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                        console.log(this.errors)
                    }
                })

            }
        }
    })
</script>
