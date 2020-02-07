<template>
    <form>
        <slot :fields="fields"></slot>
    </form>
</template>
<script>
  export default {
    name: 'FormWrapper',
    props: {
        record: {
            type: Object,
            default: () => { return {} }
        }
    },
    data () {
      return {
          fields: this.record
      }
    }
  }
</script>
