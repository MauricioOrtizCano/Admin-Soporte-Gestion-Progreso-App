import "./SideBar.css";
import React, { useState } from "react";
import { Button } from "react-bootstrap";
import AgentLoginModal from "../AgentLoginModal/AgentLoginModal";
import RequesterLoginModal from "../RequesterLoginModal/RequesterLoginModal";

const Sidebar = () => {
  const [showAgentModal, setShowAgentModal] = useState(false);
  const [showRequesterModal, setShowRequesterModal] = useState(false);

  return (
    <div className="d-grid gap-2 sidebar">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <Button
        variant="outline-info"
        size="lg"
        className="sidebar-button"
        onClick={() => setShowAgentModal(true)}
      >
        Administrar Casos Por Agente
      </Button>
      <Button
        variant="outline-danger"
        size="lg"
        className="sidebar-button"
        onClick={() => setShowRequesterModal(true)}
      >
        Casos Cerrados Solicitante
      </Button>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <AgentLoginModal
        show={showAgentModal}
        handleClose={() => setShowAgentModal(false)}
      />
      <RequesterLoginModal
        show={showRequesterModal}
        handleClose={() => setShowRequesterModal(false)}
      />
    </div>
  );
};

export default Sidebar;
