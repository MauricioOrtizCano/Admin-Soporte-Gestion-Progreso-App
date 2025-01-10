import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import { useSelector, useDispatch } from "react-redux";
import { Card, Button } from "react-bootstrap";
import { getComments, getSupportCases, getUsers } from "../../redux/actions";
import { useNavigate } from "react-router-dom";
import axios from "axios";

const RequesterPage = () => {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const { id } = useParams();

  const supportCases = useSelector(
    (state) =>
      state.supportCases?.data.filter(
        (caso) =>
          caso.requester_id === parseInt(id) && caso.status === "finished"
      ) || []
  );

  const users = useSelector((state) => state.users?.data || []);

  const comments = useSelector((state) => state.comments?.data || []);

  const getAgentName = (agentId) => {
    const agent = users.data.find((user) => user.id === agentId);
    return agent ? `${agent.name} ${agent.lastname}` : "No asignado";
  };

  const getCaseComments = (caseId) => {
    return (
      comments.find((comment) => comment.support_case_id === caseId)
        ?.comments || []
    );
  };

  console.log(supportCases);
  console.log(
    comments.find((comment) => comment.support_case_id === 5)?.comments
  );

  const onNavigateBack = () => {
    navigate("/");
  };

  useEffect(() => {
    dispatch(getSupportCases());
    dispatch(getComments());
    dispatch(getUsers());
  }, [dispatch]);
  return (
    <div className="container mx-auto p-4">
      <div className="flex justify-between items-center mb-6">
        <h3 className="text-2xl font-bold">Casos Resueltos</h3>
        <Button
          variant="outline-warning"
          className="flex items-center gap-2"
          onClick={onNavigateBack}
        >
          Volver al Inicio
        </Button>
      </div>

      {supportCases.lenght === 0 ? (
        <Card>
          <Card.Body className="p-6">
            <p className="text-center text-gray-500">
              No hay casos finalizados para mostrar
            </p>
          </Card.Body>
        </Card>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {supportCases.map((supportCase) => (
            <div>
              <Card>
                <Card.Header>
                  <Card.Title className="text-lg font-semibold">
                    Caso de Soporte #{supportCase.id}
                  </Card.Title>
                  <span className="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                    Finalizado
                  </span>
                </Card.Header>
                <Card.Body>
                  <div className="space-y-2 mb-4">
                    <div>
                      <span className="font-semibold">Fecha de entrada: </span>
                      {new Date(supportCase.entry_date).toLocaleDateString()}
                    </div>
                    <div>
                      <span className="font-semibold">
                        Fecha de finalización:{" "}
                      </span>
                      {new Date(supportCase.closed_at).toLocaleDateString()}
                    </div>
                    <div>
                      <span className="font-semibold">Agente: </span>
                      {getAgentName(supportCase.agent_id)}
                    </div>
                  </div>

                  <div>
                    <h4 className="font-semibold mb-2">
                      Historial de comentarios:
                    </h4>
                    <div className="max-h-48 overflow-y-auto space-y-2">
                      {getCaseComments(supportCase.id).map((comment, index) => (
                        <div key={index} className="border-b pb-2">
                          <span className="text-sm text-gray-500">
                            {new Date(comment.timestamp).toLocaleString()}
                          </span>
                          <p className="mt-1">{comment.text}</p>
                        </div>
                      ))}
                    </div>
                  </div>
                </Card.Body>
              </Card>
            </div>
          ))}
        </div>
      )}
    </div>
  );
};

export default RequesterPage;
