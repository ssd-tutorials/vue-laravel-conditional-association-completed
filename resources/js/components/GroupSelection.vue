<template>
    <div v-if="categories.length">
        <slot></slot>
        <ul class="rounded overflow-auto list-none max-h-10 text-gray-700 p-4 mb-4 border border-solid border-gray-500">
            <li v-for="category in categories" :key="category.value">
                <span
                    @click="toggle({ category_id: category.value })"
                    class="cursor-pointer inline-block"
                    :class="{ 'opacity-50': processing }"
                >
                    <check-box :checked="category.is_attached" />
                    <span class="text-sm">{{ category.name }}</span>
                </span>
            </li>
        </ul>
    </div>
</template>
<script>
  import CheckBox from './CheckBox'
  export default {
    name: 'GroupSelection',
    components: {CheckBox},
    props: {
        fetchAction: {
            type: String,
            required: true
        },
        toggleAction: {
            type: String,
            required: true
        }
    },
    data () {
      return {
          categories: [],
          processing: false
      }
    },
    created() {
        this.fetch({ needs_categories: 1 });
    },
    destroyed() {
        this.fetch({ needs_categories: 0 });
    },
    methods: {
        fetch(payload) {
            this.processing = true;
            axios.post(this.fetchAction, payload)
                .then(this.fetchSuccess)
                .catch(this.failure);
        },
        fetchSuccess(response) {
            this.categories = response.data;
            this.processing = false;
        },
        failure(error) {
            this.processing = false;
            console.log(error);
        },
        toggle(payload) {
            this.processing = true;
            axios.post(this.toggleAction, payload)
                .then(response => this.toggleSuccess(payload.category_id, response))
                .catch(this.failure);
        },
        toggleSuccess(category_id, response) {
            this.categories =  this.categories.map(category => {
                if (category.value !== category_id) {
                    return category;
                }
                category.is_attached = response.data.is_attached;
                return category;
            });
            this.processing = false;
        }
    }
  }
</script>
