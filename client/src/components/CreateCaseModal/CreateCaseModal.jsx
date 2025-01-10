import { useState, useMemo } from "react";
import { useDispatch, useSelector } from "react-redux";
import { Modal, Button, Form } from "react-bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import Swal from "sweetalert2";
import { createSupportCase } from "../../redux/actions";

const CreateCaseModal = ({ show, handleClose }) => {
  const [isRegistered, setIsRegistered] = useState(true);
  const [formData, setFormData] = useState({
    requester_id: "",
    name: "",
    lastname: "",
    email: "",
    status: "created",
    role: "requester",
    entry_date: new Date().toISOString().slice(0, 16),
  });

  const dispatch = useDispatch();

  const requestersRaw = useSelector((state) =>
    state.users?.data?.data?.filter((user) => user.role === "requester")
  );
  const requesters = useMemo(() => requestersRaw || [], [requestersRaw]);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const validateForm = () => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!isRegistered) {
      if (!formData.name) {
        Swal.fire({
          title: "Error",
          icon: "error",
          text: "El formulario no puede ser enviado sin Nombre",
        });
        return false;
      }

      if (!formData.lastname) {
        Swal.fire({
          title: "Error",
          icon: "error",
          text: "El formulario no puede ser enviado sin Apellido",
        });
        return false;
      }

      if (!formData.email || !emailRegex.test(formData.email)) {
        Swal.fire({
          title: "Error",
          icon: "error",
          text: "El formulario no puede ser enviado sin un correo electrónico válido",
        });
        return false;
      }
    } else {
      if (!formData.requester_id) {
        Swal.fire({
          title: "Error",
          icon: "error",
          text: "Debe seleccionar un usuario registrado",
        });
        return false;
      }
    }

    return true;
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (validateForm()) {
      // Despacha la accion con formdata
      dispatch(createSupportCase(formData));
      handleClose();
      setFormData({
        requester_id: "",
        name: "",
        lastname: "",
        email: "",
        status: "created",
        role: "requester",
        entry_date: new Date().toISOString().slice(0, 16),
      });
    }
  };

  return (
    <Modal show={show} onHide={handleClose}>
      <Modal.Header closeButton>
        <Modal.Title>Crear Caso de Soporte</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <Form onSubmit={handleSubmit}>
          <Form.Group className="mb-3" controlId="formIsRegistered">
            <Form.Check
              type="checkbox"
              label="¿Es un usuario registrado?"
              checked={isRegistered}
              onChange={(e) => setIsRegistered(e.target.checked)}
            />
          </Form.Group>

          {isRegistered ? (
            <Form.Group className="mb-3">
              <Form.Label>Seleccionar Usuario</Form.Label>
              <Form.Select
                name="requester_id"
                value={formData.requester_id}
                onChange={handleInputChange}
              >
                <option value="">Selecione un usuario</option>
                {requesters.map((user) => (
                  <option key={user.id} value={user.id}>
                    {user.name} {user.lastname}
                  </option>
                ))}
              </Form.Select>
            </Form.Group>
          ) : (
            <>
              <Form.Group controlId="formName" className="mb-3">
                <Form.Label>Nombre</Form.Label>
                <Form.Control
                  type="text"
                  name="name"
                  value={formData.name}
                  onChange={handleInputChange}
                />
              </Form.Group>

              <Form.Group controlId="formLastname" className="mb-3">
                <Form.Label>Apellido</Form.Label>
                <Form.Control
                  type="text"
                  name="lastname"
                  value={formData.lastname}
                  onChange={handleInputChange}
                />
              </Form.Group>

              <Form.Group controlId="formEmail" className="mb-3">
                <Form.Label>Email</Form.Label>
                <Form.Control
                  type="email"
                  name="email"
                  value={formData.email}
                  onChange={handleInputChange}
                />
              </Form.Group>
            </>
          )}

          <Form.Group controlId="formEntryDate" className="mb-3">
            <Form.Label>Fecha de Creación</Form.Label>
            <Form.Control
              type="text"
              name="entry_date"
              value={formData.entry_date}
              readOnly
            />
          </Form.Group>

          <Button variant="primary" type="submit">
            Crear Caso
          </Button>
        </Form>
      </Modal.Body>
    </Modal>
  );
};

export default CreateCaseModal;
