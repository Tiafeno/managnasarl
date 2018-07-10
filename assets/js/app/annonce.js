/*
 * Copyright (c) 2018 Tiafeno Finel
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files, to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

const adsRoute = angular.module('adsRoute', ['ngFileUpload'])
  .config(['$routeProvider', function ($routeProvider) {
    $routeProvider
      .when('/connexion', {
        templateUrl: annonceOptions.application_directory_uri + '/templates/our-information.route.html',
        controller: 'OurInformationController'
      })
      .when('/form', {
        templateUrl: annonceOptions.application_directory_uri + '/templates/form.route.html',
        controller: 'FormController'
      })
      .otherwise(({
        redirectTo: '/connexion'
      }))
  }])
  .factory('request', ['$http', '$q', function ($http, $q) {
    return {
      getAmenities: () => {
        return $http.get(annonceOptions.ajax_url, {
          params: {
            action: 'ajax_taxonomy_content',
            taxonomy: 'amenities'
          }
        });
      },
      getTaxonomy: (tax) => {
        return $http.get(annonceOptions.ajax_url, {
          params: {
            action: 'ajax_taxonomy_content',
            taxonomy: tax
          }
        });
      },
      sendForm: (formData) => {
        return $http({
          url: annonceOptions.ajax_url,
          method: "POST",
          headers: {'Content-Type': undefined},
          data: formData
        });
      }
    }
  }])
  .service('Property', ['request', function (request) {
    this.Prop = [
      {
        '_id': 0,
        'slug': 'house',
        'name': 'Maison'
      },
      {
        '_id': 1,
        'slug': 'ground',
        'name': 'Terrain'
      },
      {
        '_id': 2,
        'slug': 'apartment',
        'name': 'Appartement'
      }
    ];
    this.Types = [
      {
        '_id': 0,
        'slug': 'for_sale',
        'name': 'Vendre'
      },
      {
        '_id': 1,
        'slug': 'for_rent',
        'name': 'Louer'
      }
    ];
    this.Regions = () => {
      return new Promise((resolve) => {
        request
          .getTaxonomy('region')
          .then(result => {
            if (_.isEmpty(result.data)) return [];
            resolve(result.data);
          })
      })
    };

    this.Zipcode = () => {
      return new Promise((resolve) => {
        request
          .getTaxonomy('zipcode')
          .then(result => {
            if (_.isEmpty(result.data)) return [];
            resolve(result.data);
          })
      })
    };

    this.amenities = () => {
      return request.getAmenities();
    }
  }])

  .filter('propertyName', ['Property', function (Property) {
    return (slugValue) => {
      const valueArray = _.where(Property.Prop, {slug: slugValue});
      if (_.isEmpty(valueArray)) return slugValue;
      return valueArray[0].name;
    }
  }])

  .filter('isEmpty', [function () {
    return (value) => {
      return _.isEmpty(value);
    }
  }])

  .directive('preUpload', [function () {
    return {
      restrict: 'AE',
      link: (scope, element, attrs) => {
        const selector = attrs.preUpload;
        element
          .bind('click', e => {
            document.querySelector('input.' + selector).click();
          })
      }
    }
  }])
  .directive('preUploadremove', ['$parse', function ($parse) {
    return {
      restrict: 'AE',
      scope: true,
      link: (scope, element, attrs) => {
        const id = attrs.preUploadremove;
        const selector = attrs.selector;
        element
          .bind('click', e => {
            scope.$apply(() => {
              if (selector === 'gallery') {
                /** Supprimer une image de la liste */
                scope.form.galeries = _.reject(scope.form.galeries, (galerie) => {
                  return galerie.id === id;
                });
              } else {
                /** Supprimer l'image à la une */
                scope.form.featuredImage = {};
              }

              /** Initialiser l'element << input >> */
              if (_.isEmpty(scope.form.galeries) || _.isEmpty(scope.form.featuredImage)) {
                document.querySelector('input.' + selector).value = "";
              }
            });
          })
      }
    }
  }])
  .directive('inputOnChange', [function () {
    return {
      restrict: 'A',
      scope: true,
      link: (scope, element, attrs) => {
        let onChangeHandler = scope.$eval(attrs.inputOnChange);
        element.on("change", onChangeHandler);
        element.on('$destroy', function() {
          element.off();
        });
      }
    }
  }])

  .controller('OurInformationController', ['$scope', '$location', '$route',
    function ($scope, $location, $route) {
      $scope.userFormSubmit = (isValid) => {
        if (!isValid) return;
        $location.path('/form');
        $route.reload();
      };

    }])

  .controller('FormController', [
    '$scope', "$mdDialog", "$q", "$http", "$log", '$window',
    '$location', '$window', '$route', 'request', 'Property', 'Upload',
    function ($scope, $mdDialog, $q, $http, $log, $window, $location, $window, $route, request, Property, Upload) {
      $scope.Types = angular.copy(Property.Types);
      $scope.Regions = [];
      $scope.Zipcode = [];
      $scope.Properties = angular.copy(Property.Prop);
      $scope.Amenities = [];
      $scope.regionSearchText = null;
      $scope.regionQuery = (query) => {
        /** Recherche une code postal dans la liste */
        let results = query ? _.filter($scope.Zipcode, (zipcode) => {
          return zipcode.display.indexOf(query) > -1;
        }) : $scope.Zipcode();
        let deferred = $q.defer();
        if (!_.isEmpty(results))
          deferred.resolve(results);
        return deferred.promise;
      };
      $scope.form.deed = false;
      $scope.form.limited = false;

      /** Get 'equipement" or amenities taxonomy */
      Property
        .amenities()
        .then(results => {
          if (_.isEmpty(results.data)) return;
          $scope.Amenities = angular.copy(results.data);
        });

      /** Get region taxonomy */
      Property
        .Regions()
        .then(result => {
          $scope.Regions = angular.copy(result);
        });

      /** Get Zipcode taxonomy */
      Property
        .Zipcode()
        .then(result => {
          const regions = angular.copy(result);
          $scope.Zipcode = regions.map(region => {
            return {
              slug: parseInt(region.slug),
              display: region.name
            }
          });
        });

      /** Contient les équipements sélectionner */
      $scope.form.amenitieSelected = [];
      $scope.toggle = (item, list) => {
        const idx = list.indexOf(item);
        if (idx > -1) {
          list.splice(idx, 1);
        }
        else {
          list.push(item);
        }
      };
      $scope.exists = (item, list) => {
        return list.indexOf(item) > -1;
      };

      $scope.form.galeries = [];
      $scope.form.featuredImage = {};
      const fileFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

      /**
       * Cette fonction permet de redimensionner une image
       *
       * @param imgObj - the image element
       * @param newWidth - the new width
       * @param newHeight - the new height
       * @param startX - the x point we start taking pixels
       * @param startY - the y point we start taking pixels
       * @param ratio - the ratio
       * @returns {string}
       */
      const getImagePortion = (imgObj, newWidth, newHeight, startX, startY, ratio) => {
        //set up canvas for thumbnail
        const tnCanvas = document.createElement('canvas');
        const tnCanvasContext = tnCanvas.getContext('2d');
        tnCanvas.width = newWidth;
        tnCanvas.height = newHeight;

        /* use the sourceCanvas to duplicate the entire image. This step was crucial for iOS4 and under devices. Follow the link at the end of this post to see what happens when you don’t do this */
        const bufferCanvas = document.createElement('canvas');
        const bufferContext = bufferCanvas.getContext('2d');
        bufferCanvas.width = imgObj.width;
        bufferCanvas.height = imgObj.height;
        bufferContext.drawImage(imgObj, 0, 0);

        /* now we use the drawImage method to take the pixels from our bufferCanvas and draw them into our thumbnail canvas */
        tnCanvasContext.drawImage(bufferCanvas, startX, startY, newWidth * ratio, newHeight * ratio, 0, 0, newWidth, newHeight);
        return tnCanvas.toDataURL();
      };

      /**
       * Récuper les valeurs dispensable pour une image pré-upload
       * @param {File} file
       * @returns {Promise<any>}
       */
      const imgPromise = (file) => {
        return new Promise((resolve, reject) => {
          if (file) {
            let identification = $window.btoa(_.random(0, 100) + Date.now());
            let fileReader = new FileReader();
            fileReader.onload = (Event) => {
              const img = new Image();
              img.src = Event.target.result;
              img.onload = () => {
                const ms = Math.min(img.width, img.height);
                const mesure = (ms < 600) ? ms : 600;
                const startX = (ms <= 600) ? 0 : 150;
                const startY = (ms <= 600) ? 0 : 80;
                const imgCrop = getImagePortion(img, mesure, mesure, startX, startY, 1);
                resolve({
                  src: imgCrop,
                  id: identification
                })
              };
            };
            fileReader.readAsDataURL(file);
          } else {
            reject(false);
          }
        });
      };

      $scope.previewFeaturedFile = (event) => {
          const element = event.target;
          if (element.files.length === 0) {
            $scope.$apply(() => {
              $scope.form.featuredImage = {};
            });
            return;
          }
          angular.forEach(element.files, file => {
            if (!fileFilter.test(file.type)) {
              return;
            }
            imgPromise(file)
              .then(result => {
                $scope.$apply(() => {
                  $scope.form.featuredImage = angular.copy(result);
                });
              })
              .catch(e => {
                $log.warn("Le fichier image n'existe pas");
              })
          })
      };

      $scope.previewGalleryFile = (event) => {
        const currentElement = event.target;
        if (currentElement.files.length === 0) {
          $scope.$apply(() => {
            $scope.form.galeries = [];
          });
          return;
        }
        angular.forEach(currentElement.files, (file, index) => {
          if (!fileFilter.test(file.type)) {
            console.info('You must select a valid image file!');
            return;
          }
          imgPromise(file)
            .then((successCallback) => {
              $scope.$apply(() => {
                $scope.form.galeries.push(successCallback);
              });
            })
            .catch(e => {
              console.warn("Le fichier image n'existe pas");
            })
        }); // forEach
      };

      $scope.init = () => {
      };

      /**
       * Envoyer une seul image
       * @param file
       * @returns {*}
       */
      const uploadFile = (file, post_id) => {
        return Upload.upload({
          url: annonceOptions.ajax_url,
          data: {
            file: file,
            action: 'ajax_upload_media',
            post_id: post_id
          },
          method: 'POST'
        });
      };

      /**
       * Envoyer plusieur fichiers
       * @param files
       */
      const uploadFiles = (files, post_id) => {
        return Upload.upload({
          url: annonceOptions.ajax_url,
          data: {
            files: files,
            action: 'ajax_upload_medias',
            post_id: post_id
          },
          method: 'POST'
        });
      };

      const sendSuccess = (successCallback) => {
        $mdDialog.show(
          $mdDialog.alert()
            .parent(angular.element(document.querySelector('body')))
            .clickOutsideToClose(false)
            .title('Notification')
            .textContent('Votre annnonce a bien etès ajouter avec succès, ' +
              'L\'administrateur doit verifier les informations avant sa publication.')
            .ariaLabel('Notification')
            .ok('Valider')
        )
        .finally(() => {
          $log.info('Dialog close!');
        });
      };

      $scope.annonceFormSubmit = (isValid) => {
        if (!isValid) return;
        const postForm = new FormData();
        postForm.append('action', 'ajax_insert_annonce');
        postForm.append('title', $scope.form.title);
        postForm.append('content', $scope.form.description);
        postForm.append('property', $scope.form.property); // ground, house & apartment
        postForm.append('price', $scope.form.price);
        postForm.append('deed', $scope.form.deed ? 1 : 0); // bool
        postForm.append('limited', $scope.form.limited ? 1 : 0); // bool

        if ( ! _.isUndefined($scope.form.default_rate))
          postForm.append('default_rate',  $scope.form.default_rate); // seasonal & monthly

        if ( ! _.isUndefined($scope.form.price_seasonal))
          postForm.append('price_seasonal', $scope.form.price_seasonal);

        request
          .sendForm(postForm)
          .then(result => {
            const data = result.data;
            const post_id = data.post_id;
            const featuredFile = document.querySelector('input.featured').files;
            const galleryFiles = document.querySelector('input.gallery').files;

            /** Upload featured image */
            const asyncUploadFeatured = (File) => {
              let deferred = $q.defer();
              if (File.length > 0) {
                uploadFile(File[0], post_id)
                  .then(resp => {
                    deferred.resolve(resp.data);
                  }, resp => {
                    deferred.reject('Error status: ' + resp.status);
                  });
              } else {
                deferred.resolve(null);
              }
              return deferred.promise;
            };

            /** Upload gallery files */
            const asyncUploadGaleries = (Files) => {
              let deferred = $q.defer();
              if (Files.length > 0) {
                uploadFiles(Files, post_id)
                  .then(resp => {
                    deferred.resolve(resp.data);
                  }, resp => {
                    deferred.reject('Error status: ' + resp.status);
                  });
              } else {
                deferred.resolve(null);
              }
              return deferred.promise;
            };

            // TODO: Ajouter un champ description dans le formulaire

            let error = false;
            let promiseFeatured = asyncUploadFeatured(featuredFile);
            let promiseGaleries = asyncUploadGaleries(galleryFiles);
            let updateForm = new FormData();
            updateForm.append('action', 'ajax_update_annonce');
            updateForm.append('post_id', post_id);
            updateForm.append('type', $scope.form.type);

            /** Les adresses */
            updateForm.append('region', $scope.form.region); // taxonomy
            updateForm.append('city', $scope.form.city);
            updateForm.append('address', $scope.form.address);
            updateForm.append('zipcode', JSON.stringify($scope.form.zipcode)); // taxonomy

            /** Type de bien */
            updateForm.append('property', $scope.form.property);
            updateForm.append('owner', $scope.form.owner_name);

            /** Client */
            const userForm = {
              phone: $scope.user.phone,
              email: $scope.user.email,
              name:  $scope.user.name
            };
            updateForm.append('user', JSON.stringify(userForm));

            switch ($scope.form.property) {
              case 'ground':
                updateForm.append('deed', $scope.form.deed);
                updateForm.append('limited', $scope.form.limited);
                break;

              case 'house':
              case 'apartment':
                updateForm.append('bedroom', $scope.form.bedroom);
                updateForm.append('kitchen', $scope.form.kitchen);
                updateForm.append('bathroom', $scope.form.bathroom);
                updateForm.append('garage', $scope.form.garage);
                /** Les équipements */
                updateForm.append('amenities', JSON.stringify($scope.form.amenitieSelected));
                break;
              default:
                error = true;
            } // .end switch

            /** Superficie */
            updateForm.append('surface', $scope.form.surface);
            updateForm.append('unit', $scope.form.unit);

            if ( ! error)
              $http({
                url: annonceOptions.ajax_url,
                method: "POST",
                headers: {'Content-Type': undefined},
                data: updateForm
              })
                .then(response => {
                  promiseFeatured
                    .then((featuredSuccess) => {
                      if ( ! _.isString(featuredSuccess)) {
                        if (_.isNull(featuredSuccess) || featuredSuccess.success) {
                          if (_.isObject(featuredSuccess)) {
                            if (featuredSuccess.success)
                              $log.info('Featured image upload successfully');
                          }

                          promiseGaleries.then(gallerySuccess => {
                            if (_.isString(gallerySuccess)) { $log.error(gallerySuccess); return; }
                            if (_.isObject(gallerySuccess)) {
                              if (gallerySuccess.success)
                                $log.info('Gallery upload without error');
                            }

                            // Update without error
                            sendSuccess(response.data);
                          }, reason => {
                            $log.warn(reason);
                          });
                        } else $log.warn(featuredSuccess.msg);

                      } else $log.error(featuredSuccess);

                    }, reason => {
                      $log.warn(reason);

                    });
                });

          });

      };

      /** Rechercher un mot dans la liste select (Region) */
      $scope.searchRegion;
      $scope.clearSearchTerm = () => {
        $scope.searchRegion = '';
      };
      jQuery('form').find('input').on('keydown', ev => {
        ev.stopPropagation();
      });

      jQuery('.ui.dropdown').dropdown();

      /** Bloquer l'access si les informations d'utilisateur ne sont pas present */
      if (_.isEmpty($scope.user)) {
        $location.path('/connexion');
        $route.reload();
      } else {
        $scope.init();
      }


    }]);

const ANNONCE = angular.module('annonceModule',
  [
    'ngRoute',
    "ngMessages",
    'ngSanitize',
    'ngMaterial',
    'ngAria',
    'ngAnimate',

    'adsRoute'
  ]
)
  .controller('annonceCTRL', ['$scope', '$log', function ($scope, $log) {
    $scope.appUrl = annonceOptions.application_directory_uri;
    $scope.user = {};
    $scope.form = {};

    $scope.$watch('form', (newvalue, oldvalue) => {
        $log.info(newvalue);
    },true);

  }]);