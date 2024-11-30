// const counters = document.querySelectorAll(".counters spam");
// const containers = document.querySelectorAll(".counters");

// let activated = false;

// window.addEventListener("scroll", () => {
//     containers.forEach((container) => {


//         if (
//             window.pageYOffset > container.offsetTop - container.offsetHeight - 0 &&
//             activated === false
//         ) {
//             activated = true;

//             counters.forEach((counter) => {
//                 let increment = parseFloat(counter.getAttribute("data-increment"));
//                 counter.innerText = 0;
//                 let count = 0;

//                 function updateCount() {
//                     const target = parseFloat(counter.dataset.count);

//                     if (count <= target) {
//                         count += increment;
//                         counter.innerText = count;

//                         setTimeout(updateCount, 100);
//                     } else {
//                         counter.innerText = target;
//                     }
//                 }

//                 updateCount();
//             });
//         }
//     });
// });
