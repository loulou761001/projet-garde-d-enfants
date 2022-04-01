// fetch('https://maps.googleapis.com/maps/api/distancematrix/json?origins=6+rue+amedee+dormoy&destinations=2+rue+du+renard&key=AIzaSyB7Bd7FBAfcCuG-i0hKlQBpPX3ytXB0qg0',{mode: 'no-cors' }).then(function(response) {
//     console.log(response);
// })

// fetch('https://maps.googleapis.com/maps/api/distancematrix/json?origins=40.6655101%2C-73.89188969999998&destinations=40.659569%2C-73.933783%7C40.729029%2C-73.851524%7C40.6860072%2C-73.6334271%7C40.598566%2C-73.7527626&key=AIzaSyB7Bd7FBAfcCuG-i0hKlQBpPX3ytXB0qg0',{mode: 'no-cors' }).then(function(response) {
//     console.log(response);
// })
// // console.log(test)



fetch('https://maps.googleapis.com/maps/api/distancematrix/json?origins=40.6655101%2C-73.89188969999998&destinations=40.659569%2C-73.933783%7C40.729029%2C-73.851524%7C40.6860072%2C-73.6334271%7C40.598566%2C-73.7527626&key=AIzaSyB7Bd7FBAfcCuG-i0hKlQBpPX3ytXB0qg0',{mode: 'no-cors' })
    .then(function (response) {
        console.log(JSON.stringify(response));
    })
    .catch(function (error) {
        console.log(error);
    });