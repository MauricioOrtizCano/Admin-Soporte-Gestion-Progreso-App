import "./App.css";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import MainPage from "./components/MainPage/MainPage";
import AgentPage from "./components/AgentPage/AgentPage";
import RequesterPage from "./components/RequesterPage/RequesterPage";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<MainPage />} />
        <Route path="/agente/:id" element={<AgentPage />} />
        <Route path="/solicitante/:id" element={<RequesterPage />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
