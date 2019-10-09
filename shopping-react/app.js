class App extends React.Component {
    constructor(props) {
      super(props);
      this.state = {
        products: [
          {
            id: 1,
            name: "Sản phẩm thứ 1",
            image: "https://via.placeholder.com/200x150",
            description: "Description for product item number 1",
            price: 540000,
            quantity: 2
          },
          {
            id: 2,
            name: "Sản phẩm thứ 2",
            image: "https://via.placeholder.com/200x150",
            description: "Description for product item number 2",
            price: 1230000,
            quantity: 1
          },
          {
            id: 3,
            name: "Sản phẩm thứ 3",
            image: "https://via.placeholder.com/200x150",
            description: "Description for product item number 3",
            price: 400000,
            quantity: 4
          },
          {
            id: 4,
            name: "Sản phẩm thứ 4",
            image: "https://via.placeholder.com/200x150",
            description: "Description for product item number 4",
            price: 780000,
            quantity: 7
          }
        ]
      };
    }
}

function convertMoney(price) {
    return new Intl.NumberFormat("vi-VN", {
      style: "currency",
      currency: "VND"
    }).format(price);
  }

render() {
   return (
    <main>
        <MyHeader />
        <Products />
        <Checkout />
    </main>
   );
}