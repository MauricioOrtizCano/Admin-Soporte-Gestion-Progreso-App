import Header from "../Header/Header";
import Sidebar from "../Sidebar/Sidebar";
import Body from "../Body/Body";
import "./MainPage.css";
import { useEffect, useState } from "react";
import { Button } from "bootstrap";

const MainPage = () => {
  const [count, setCount] = useState(0);
  return (
    <div className="container">
      <Header />
      <Sidebar />
      <Body />
    </div>
  );
};

export default MainPage;
