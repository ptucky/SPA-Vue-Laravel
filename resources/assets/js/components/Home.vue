<template>
    <div class="container">
        <div class="login row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Disk Usage Overview</div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-2">Total Size:</div>
                            <div class="col-md-10">{{ disk.mb }} MB ({{ disk.b }}B)</div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">No of files:</div>
                            <div class="col-md-10">{{ disk.no_file }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div style="clear: both; height: 30px;"></div>
        <div class="login row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Disk Usage Compositions</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">No of files</th>
                                    <th scope="col">Size</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>image/jpg</td>
                                    <td>{{ disk.jpg }}</td>
                                    <td>{{ disk.jpg_size }}</td>
                                </tr>
                                <tr>
                                    <td>image/png</td>
                                    <td>{{ disk.png }}</td>
                                    <td>{{ disk.png_size }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  mounted() {
    this.getDiskUsage();
  },
  data: () => ({
    disk: []
  }),
  methods: {
    getDiskUsage() {
      //Get
      axios
        .get(`/api/diskUsage/${this.$store.getters.currentUser.id}`)
        .then(res => {
          this.disk = res.data;
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>