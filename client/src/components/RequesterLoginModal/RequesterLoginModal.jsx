import React, { useState } from "react";
import { Modal, Button, Form } from "react-bootstrap";
import { useNavigate } from "react-router-dom";
import { useSelector } from "react-redux";

const RequesterLoginModal = ({ show, handleClose }) => {
  const [email, setEmail] = useState("");
  const [error, setError] = useState("");

  const navigate = useNavigate();
  const users = useSelector((state) => state.users?.data?.data || []);

  const handleSubmit = (e) => {
    e.preventDefault();
    const requester = users.find(
      (user) => user.email === email && user.role === "requester"
    );

    if (requester) {
      navigate(`/solicitante/${requester.id}`);
      handleClose();
    } else {
      setError("Correo no encontrado o no corresponde a un solicitante");
    }
  };

  return (
    <Modal show={show} onHide={handleClose}>
      <Modal.Header closeButton>
        <Modal.Title>Acceso de Solicitante</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <Form onSubmit={handleSubmit}>
          <Form.Group className="mb-3">
            <Form.Label>Correo electrónico</Form.Label>
            <Form.Control
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Ingrese su correo"
              required
            />
          </Form.Group>
          {error && <div className="text-danger mb-3">{error}</div>}
          <Button variant="primary" type="submit">
            Ingresar
          </Button>
        </Form>
      </Modal.Body>
    </Modal>
  );
};

export default RequesterLoginModal;
