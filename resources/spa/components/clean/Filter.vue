<template>
  <div>
    <input type="text" placeholder="Search for names.." v-model="filterTerm"
           @keyup="filter()">

    <table id="filter-table">
      <thead>
      <tr>
        <th>Name</th>
        <th>Country</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>Alfreds Futterkiste</td>
        <td>Germany</td>
      </tr>
      <tr>
        <td>Berglunds snabbkop</td>
        <td>Sweden</td>
      </tr>
      <tr>
        <td>Island Trading</td>
        <td>UK</td>
      </tr>
      <tr>
        <td>Koniglich Essen</td>
        <td>Germany</td>
      </tr>
      <tr>
        <td>Laughing Bacchus Winecellars</td>
        <td>Canada</td>
      </tr>
      <tr>
        <td>Magazzini Alimentari Riuniti</td>
        <td>Italy</td>
      </tr>
      <tr>
        <td>North/South</td>
        <td>UK</td>
      </tr>
      <tr>
        <td>Paris specialites</td>
        <td>France</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'Filter',
  data() {
    return {
      filterTerm: '',
      dataType: 'table',
      sourceId: 'filter-table',
    }
  },
  mounted() {

  },
  methods: {
    filter() {
      switch (this.dataType) {
        case 'table':
          let td;
          const table = document.getElementById(this.sourceId);
          const tr = table.getElementsByTagName('tr');

          for (let i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName('td')[0];
            if (td) {
              if (td.textContent.toUpperCase().indexOf(this.filterTerm.toUpperCase()) > -1) {
                tr[i].style.display = '';
              } else {
                tr[i].style.display = 'none';
              }
            }
          }
          break;
        case 'list':
          const list = document.getElementById(this.sourceId);
          const li = list.getElementsByTagName('li');

          for (let i = 0; i < li.length; i++) {
            if (li[i].textContent.toUpperCase().indexOf(this.filterTerm.toUpperCase()) > -1) {
              li[i].style.display = '';
            } else {
              li[i].style.display = 'none';
            }
          }
          break;
        default:
          break;
      }
    },
  },

}

</script>
