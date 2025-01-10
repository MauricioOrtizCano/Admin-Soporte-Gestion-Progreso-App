import "./Body.css";
import { useSelector, useDispatch } from "react-redux";
import { getSupportCases, getUsers } from "../../redux/actions.js";
import { useEffect, useState } from "react";
import { Button } from "react-bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import CreateCaseModal from "../CreateCaseModal/CreateCaseModal.jsx";
import AssignAgentModal from "../AssignAgent/AssignAgentModal.jsx";

const Body = () => {
  const [show, setShow] = useState(false);

  const [showCreateModal, setShowCreateModal] = useState(false);
  const [showAssignModal, setShowAssignModal] = useState(false);
  const [selectedCase, setSelectedCase] = useState(null);

  const dispatch = useDispatch();

  // Obtenemos los datos usando selectores más específicos
  const supportCases = useSelector((state) => state.supportCases?.data || []);
  const users = useSelector((state) => state.users?.data?.data || []);
  //console.log(users);
  // Función para encontrar un usuario por ID
  const findUser = (userId) => {
    return users.find((user) => user.id === userId) || {};
  };

  const handleOpenModal = () => {
    setShow(true);
  };

  const handleClose = () => {
    setShow(false);
  };

  useEffect(() => {
    // Cargamos tanto los casos como los usuarios
    dispatch(getSupportCases());
    dispatch(getUsers());
  }, [dispatch]);

  const handleOpenAssignModal = (supportCase) => {
    setSelectedCase(supportCase);
    setShowAssignModal(true);
  };

  const handleCloseAssignModal = () => {
    setShowAssignModal(false);
    setSelectedCase(null);
  };

  return (
    <div className="body">
      <div className="button-container">
        <Button variant="primary" onClick={handleOpenModal}>
          + Crear Caso
        </Button>
      </div>

      <table className="table table-striped">
        <thead>
          <tr>
            <th>ID Caso</th>
            <th>Estado</th>
            <th>Solicitante</th>
            <th>Correo Solicitante</th>
            <th>Fecha de Ingreso</th>
            <th>Agente Asignado</th>
            <th>Asignar Agente</th>
          </tr>
        </thead>
        <tbody>
          {supportCases.map((supportCase) => {
            const requester = findUser(supportCase.requester_id);
            const agent = findUser(supportCase.agent_id);

            return (
              <tr key={supportCase.id}>
                <td>{supportCase.id}</td>
                <td>
                  <span className={`status-badge ${supportCase.status}`}>
                    {supportCase.status}
                  </span>
                </td>
                <td>{`${requester.name || ""} ${requester.lastname || ""}`}</td>
                <td>{requester.email || "N/A"}</td>
                <td>{new Date(supportCase.entry_date).toLocaleDateString()}</td>
                <td>
                  {agent ? `${agent.name} ${agent.lastname}` : "Sin asignar"}
                </td>
                <td>
                  {!supportCase.agent_id && (
                    <Button
                      variant="warning"
                      className="btn-sm"
                      onClick={() => handleOpenAssignModal(supportCase)}
                    >
                      Asignar
                    </Button>
                  )}
                </td>
              </tr>
            );
          })}
        </tbody>
      </table>

      <CreateCaseModal show={show} handleClose={handleClose} />

      <AssignAgentModal
        show={showAssignModal}
        handleClose={handleCloseAssignModal}
        supportCase={selectedCase}
      />
    </div>
  );
};

export default Body;
