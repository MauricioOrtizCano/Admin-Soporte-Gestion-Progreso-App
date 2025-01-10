import { Modal, Button, Form } from "react-bootstrap";
import { useSelector, useDispatch } from "react-redux";
import { useState } from "react";
import { assignAgent } from "../../redux/actions";
import axios from "axios";

const AssignAgentModal = ({ show, handleClose, supportCase }) => {
  const dispatch = useDispatch();
  const [selectedAgent, setSelectedAgent] = useState("");

  // Obtenemos solo los usuarios que son agentes
  const agents = useSelector(
    (state) =>
      state.users?.data?.data?.filter((user) => user.role === "agent") || []
  );

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!selectedAgent || !supportCase) return;

    try {
      await dispatch(assignAgent(supportCase.id, selectedAgent));
      console.log(selectedAgent);
      console.log(supportCase.id);
      // await axios.post(`http://127.0.0.1:8000/api/comments`, {
      //   support_case_id: supportCase.id,
      //   agent_id: selectedAgent,
      //   comments: [
      //     {
      //       text: "El Agente ha sido asignado",
      //     },
      //   ],
      // });
      handleClose();
      setSelectedAgent(""); // Resetear el valor seleccionado
    } catch (error) {
      console.error("Error al asignar agente:", error);
    }
  };

  return (
    <Modal show={show} onHide={handleClose}>
      <Modal.Header closeButton>
        <Modal.Title>Asignar Agente al Caso #{supportCase?.id}</Modal.Title>
      </Modal.Header>
      <Form onSubmit={handleSubmit}>
        <Modal.Body>
          <Form.Group className="mb-3">
            <Form.Label>Seleccionar Agente</Form.Label>
            <Form.Select
              value={selectedAgent}
              onChange={(e) => setSelectedAgent(e.target.value)}
              required
            >
              <option value="">Seleccione un agente</option>
              {agents.map((agent) => (
                <option key={agent.id} value={agent.id}>
                  {`${agent.name} ${agent.lastname} (${agent.email})`}
                </option>
              ))}
            </Form.Select>
          </Form.Group>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleClose}>
            Cancelar
          </Button>
          <Button variant="primary" type="submit">
            Asignar
          </Button>
        </Modal.Footer>
      </Form>
    </Modal>
  );
};

export default AssignAgentModal;
