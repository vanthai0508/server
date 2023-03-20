<template>
  <center>
    <h1 style="text-align: center; 
        color: green">GeeksforGeeks</h1>
    <strong>
        Vue.js Form Input Binding with Select option
    </strong>
    <br />
  </center>
  <center>
    <div>
      Data Structure : {{ category }}
      <br />
      <select v-model="category">
        <option value="Array">Array</option>
        <option value="Queue">Queue</option>
        <option value="Priority Queue">Priority Queue</option>
        <option value="Linked List">Linked List</option>
      </select>
    </div>
    <br />
    <div>
      Programming Language : {{ language }}
      <br />
      <select v-model="language" multiple>
        <option value="Java">Java</option>
        <option value="C++">C++</option>
        <option value="Python">Python</option>
        <option value="Javascript">Javascript</option>
      </select>
    </div>
    <br />
    <div>
      Select the number:
      <select v-model="choose">
        <option :value="{ number: 987 }">987</option>
        <option :value="{ number: 258 }">258</option>
        <option :value="{ number: 456 }">456</option>
      </select>
    </div>
  </center>
</template>
<script>

export default {
  data() {
    return {
      category: '',
      language: '',
    }
  },
}
</script>