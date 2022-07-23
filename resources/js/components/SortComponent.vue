<template>
  <select class="btn btn-sm btn-outline-secondary dropdown-toggle"
    data-component-name="SortComponent"
    v-model="activeIdx"
  >

      <option
        v-for="(option, idx) of $options.options"
        :key="idx"
        :value="idx"
        :disabled="idx === 0"
      >
      {{ option.label }}
    </option>
  </select>
</template>

<script>
export default {
  name: 'SortComponent',
  options: [
      {
          direction: null,
          field: null,
          label: 'Не выбранна',
      },
    {
      direction: 'ASC',
      field: 'name',
      label: 'Название по возрастанию',
    },
    {
      direction: 'DESC',
      field: 'name',
      label: 'Название по убыванию',
    },
    {
      direction: 'ASC',
      field: 'price',
      label: 'Цена по возрастанию',
    },
    {
      direction: 'DESC',
      field: 'price',
      label: 'Цена по убыванию',
    },
  ],
  data() {
    return {
      activeIdx: 0,
    };
  },
  watch: {
      activeIdx(Idx) {
      this.$emit('sort', this.$options.options[Idx]);
    },
  },
};
</script>
