<template>
    <div class="uploader"
        @dragenter="OnDragEnter" 
        @dragleave="OnDragLeave" 
        @dragover.prevent 
        @drop="onDrop" 
        :class="{ dragging: isDragging }">
        

        <div class="upload-control" v-show="images.length">
            <label for="file">Select a file</label>
            <button @click="upload">Upload</button>
        </div>

        <div v-show="!images.length">
            <i class="fa fa-cloud-upload"></i>
            <p>Drag your images here</p>
            <div>OR</div>
            <div class="file-input">
                <label for="file">Select a file</label>
                <input type="file" id="file" @change="onInputChange" multiple>
            </div>
        </div>

        <div class="images-preview" v-show="images.length">
            <div class="img-wrapper" v-for="(image, index) in images" :key="index">
                <img :src="image" :alt="`Image Uplaoder ${index}`">
                <div class="details">
                    <span class="name" v-text="files[index].name"></span>
                    <span class="size" v-text="getFileSize(files[index].size)"></span>
                </div>
            </div>
        </div>

       <div class="images-preview">
            <div class="img-wrapper" v-for="tk in galleries" :key="tk.id">
                <img :src="getImage(tk.image_name)">
                <div class="details">
                    <ul class="gall-menu">
                        <li>
                            <a href="#" class="delete" @click.prevent="deleteGallery(tk)">
                                <span class="oi oi-trash"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="view" @click.prevent="">
                                <span class="oi oi-zoom-in"></span>
                            </a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div> 

    </div>
</template>

<script>
export default {
  mounted() {
    this.fetchDataGallery();
  },
  data: () => ({
    isDragging: false,
    dragCount: 0,
    files: [],
    images: [],
    galleries: []
  }),
  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    }
  },
  methods: {
    getImage(imgName) {
      return "storage/" + this.$store.getters.currentUser.id + "/" + imgName;
    },
    OnDragEnter(e) {
      e.preventDefault();

      this.dragCount++;
      this.isDragging = true;

      return false;
    },
    OnDragLeave(e) {
      e.preventDefault();
      this.dragCount--;

      if (this.dragCount <= 0) this.isDragging = false;
    },
    onInputChange(e) {
      const files = e.target.files;
      Array.from(files).forEach(file => this.addImage(file));
    },
    onDrop(e) {
      e.preventDefault();
      e.stopPropagation();

      this.isDragging = false;
      const files = e.dataTransfer.files;

      Array.from(files).forEach(file => this.addImage(file));
    },
    addImage(file) {
      //if (!file.type.match('image.*')) {
      if (!file.type.match("image/jpeg") && !file.type.match("image/png")) {
        this.$toastr.e(`${file.name} is not an image`);
        return;
      }

      this.files.push(file);
      const img = new Image(),
        reader = new FileReader();

      reader.onload = e => this.images.push(e.target.result);
      reader.readAsDataURL(file);
    },
    getFileSize(size) {
      const fSExt = ["Bytes", "KB", "MB", "GB"];
      let i = 0;

      while (size > 900) {
        size /= 1024;
        i++;
      }

      return `${Math.round(size * 100) / 100} ${fSExt[i]}`;
    },
    fetchDataGallery() {
      //Get
      //this.axios.defaults.baseURL = '/';
      axios
        .get(`/api/imageGallery/${this.$store.getters.currentUser.id}`)
        .then(res => {
          this.galleries = res.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    upload() {
      //Add
      //Send as FormData
      const formData = new FormData();
      this.files.forEach(file => {
        formData.append("images[]", file, file.name);
      });

      // Append uId
      formData.append("user_id", this.$store.getters.currentUser.id);
      axios
        .post("/images-upload", formData, {
          onUploadProgress: progressEvent => {
            //console.log(progressEvent.loaded / progressEvent.total)
          }
        })
        .then(response => {
          this.images = [];
          this.files = [];

          response.data.user_id = this.$store.getters.currentUser.id;
          axios
            .post("/api/imageGallery", response.data)
            .then(res => {
              var i;
              for (i = 0; i < res.data.length; i++) {
                this.galleries.unshift(res.data[i]);
              }

              response.data = [];
              this.$toastr.s("Images Update successfully");
            })
            .catch(err => {
              console.log(err);
            });
        })
        .catch(err => {
          console.log(err);
        });
    },
    deleteGallery(tk) {
      //Delete
      //this.axios.defaults.baseURL = '/';
      axios
        .delete(
          `/api/imageGallery/${tk.id}/${this.$store.getters.currentUser.id}`
        )
        .then(res => {
          const taskIndex = this.galleries.indexOf(tk);
          this.galleries.splice(taskIndex, 1);
          console.log("Delete");
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>


<style lang="scss" scoped>
.uploader {
  width: 100%;
  background: #2196f3;
  color: #fff;
  padding: 40px 15px;
  text-align: center;
  border-radius: 10px;
  border: 3px dashed #fff;
  font-size: 20px;
  position: relative;

  &.dragging {
    background: #fff;
    color: #2196f3;
    border: 3px dashed #2196f3;

    .file-input label {
      background: #2196f3;
      color: #fff;
    }
  }

  i {
    font-size: 85px;
  }

  .file-input {
    width: 200px;
    margin: auto;
    height: 68px;
    position: relative;

    label,
    input {
      background: #fff;
      color: #2196f3;
      width: 100%;
      position: absolute;
      left: 0;
      top: 0;
      padding: 10px;
      border-radius: 4px;
      margin-top: 7px;
      cursor: pointer;
    }

    input {
      opacity: 0;
      z-index: -2;
    }
  }

  .images-preview {
    display: flex;
    flex-wrap: wrap;
    margin-top: 20px;

    .img-wrapper {
      width: 160px;
      display: flex;
      flex-direction: column;
      margin: 10px;
      height: 150px;
      justify-content: space-between;
      background: #fff;
      box-shadow: 5px 5px 20px #3e3737;

      img {
        max-height: 105px;
      }
    }

    .details {
      font-size: 12px;
      background: #fff;
      color: #000;
      display: flex;
      flex-direction: column;
      align-items: self-start;
      padding: 3px 6px;

      .name {
        overflow: hidden;
        height: 18px;
      }
    }
  }

  .upload-control {
    position: absolute;
    width: 100%;
    background: #fff;
    top: 0;
    left: 0;
    border-top-left-radius: 7px;
    border-top-right-radius: 7px;
    padding: 10px;
    padding-bottom: 4px;
    text-align: right;

    button,
    label {
      background: #2196f3;
      border: 2px solid #03a9f4;
      border-radius: 3px;
      color: #fff;
      font-size: 15px;
      cursor: pointer;
    }

    label {
      padding: 2px 5px;
      margin-right: 10px;
    }
  }

  .is-24x24 img {
    width: 150px;
  }
}

ul.gall-menu {
  list-style: none;
  display: flex;
  padding-top: 10px;

  a.delete span,
  a.view span {
    font-size: 20px;
  }
}
</style>